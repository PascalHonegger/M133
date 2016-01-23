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

$query = 'SELECT payment_limit, user_ID FROM account WHERE acc_ID = ' . $from;

$result = mysqli_query($db, $query);

$row = mysqli_fetch_assoc($result);

// Konto gehört angemeldetem User
$accountOwnerID = $row['user_ID'];

if($accountOwnerID != $user['user_ID'])
{
    $error = 52;
    header('Location: ../index.php?action=givemoney&error=' . $error);
}

// Kontolimit ausrechnen
$limit = $row['payment_limit'];

$query = 'SELECT trans_amount FROM transaction WHERE DATE(execution_time) = CURDATE() AND trans_sender = ' . $from;

$result = mysqli_query($db, $query);

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
    header('Location: ../index.php?action=givemoney&error=' . $error);
}
else{
    mysqli_begin_transaction($db);

    $query = "INSERT INTO transaction(trans_sender, trans_reciever, trans_amount, trans_type) VALUES($from, $to, $amount, '$type')";

    $try1 = mysqli_query($db, $query);

    $query = 'UPDATE account SET balance= balance + ' . $amount . ' WHERE acc_ID=' . $to;

    $try2 = mysqli_query($db, $query);

    $query = 'UPDATE account SET balance = balance - ' . $amount . ' WHERE acc_ID=' . $from;

    $try3 = mysqli_query($db, $query);

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

