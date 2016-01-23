<?php

require_once '../include/db_connection.inc';
require 'variables.php';

// User angemeldet
if($user == null)
{
    $error = 42;
    header('Location: ../index.php?action=register&error=' . $error);
}

// Positiver Betrag
if($amount <= 0)
{
    $error = 26;
    header('Location: ../index.php?action=register&error=' . $error);
}

// Konto des senders wählen

$query = 'SELECT payment_limit, user_ID FROM account WHERE acc_ID = ?';

$stmt = mysqli_prepare($db, $query);

$stmt->bind_param('i',$from);

$result = $stmt->execute();

$result = $stmt->get_result();

$stmt->close();

$row = mysqli_fetch_assoc($result);

// Konto gehört angemeldetem User
$accountOwnerID = $row['user_ID'];

if($accountOwnerID != $user['user_ID'])
{
    $error = 52;
    header('Location: ../index.php?action=givemoney&error=' . $error);
} else {

    // Kontolimit ausrechnen
    $limit = $row['payment_limit'];

    $query = 'SELECT trans_amount FROM transaction WHERE DATE(execution_time) = CURDATE() AND trans_sender = ?';

    $stmt = mysqli_prepare($db, $query);

    $stmt->bind_param('s',$from);

    $result = $stmt->execute();

    $result = $stmt->get_result();

    $stmt->close();

    $spentThisMonth = 0;

    while($row = mysqli_fetch_assoc($result))
    {
        $spentThisMonth += $row['trans_amount'];
    }

    $spentThisMonth += $amount;

    // Kontolimit überschritten
    if($spentThisMonth >= $limit)
    {
        $error = 43;
        //header('Location: ../index.php?action=givemoney&error=' . $error);
    }
    else{
        mysqli_begin_transaction($db);

        // Erstelle neue Transaktion
        $query = 'INSERT INTO transaction(trans_sender, trans_reciever, trans_amount, trans_type) VALUES(?, ?, ?, ?)';

        $stmt = mysqli_prepare($db, $query);

        $stmt->bind_param('iids',$from, $to, $amount, $type);

        $try1 = $stmt->execute();

        $stmt->close();

        // Bewege Geld
        $query = 'UPDATE account SET balance = balance + ? WHERE acc_ID=?';

        $stmt = mysqli_prepare($db, $query);

        $stmt->bind_param('di',$amount, $to);

        $try2 = $stmt->execute();

        $stmt->close();

        $query = 'UPDATE account SET balance = balance - ? WHERE acc_ID=?';

        $stmt = mysqli_prepare($db, $query);

        $stmt->bind_param('di',$amount, $from);

        $try3 = $stmt->execute();

        $stmt->close();

        if($try1 && $try2 && $try3)
        {
            mysqli_commit($db);
            $error  = 0;
        }
        else
        {
            mysqli_rollback($db);
            $error  = 93;
        }

        header('Location: ../index.php?action=givemoney&error=' . $error);
    }
}

