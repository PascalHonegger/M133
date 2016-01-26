<?php
require_once '../include/db_connection.inc';
require 'variables.php';


if($user != null)
{
    $userid = $user['user_ID'];

    $query = 'insert into account(balance,payment_limit,type,user_ID,acc_name) values (0,?,?,?,?);';

    $stmt = mysqli_prepare($db, $query);

    $stmt->bind_param('dsis',$limit, $accounttype, $userid, $accountname);

    $result = $stmt->execute();

    $stmt->close();

    if($result)
    {
        header('Location: ../index.php?action=welcome');
    }
    else
    {
        $error = 50;
        header('Location: ../index.php?action=welcome&error='.$error);
    }
}
else
{
    $error = 60;
    header('Location: ../index.php?action=welcome&error='.$error);
}


