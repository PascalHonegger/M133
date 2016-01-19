<?php
/**
 * Created by PhpStorm.
 * User: Alain
 * Date: 19.01.2016
 * Time: 14:25
 */
include '../include/db_connection.inc';
include 'variables.php';


if($user != null)
{
    $accountname = $_POST['accountname'];
    $accounttype = $_POST['accounttype'];
    $limit = $_POST['limit'];
    $userid = $user['user_ID'];

    $query = "insert into account(balance,payment_limit,type,user_ID,acc_name) values (0,$limit,'$accounttype','$userid','$accountname');";
    var_dump($query);

    $result = mysqli_query($db, $query);
    if($result)
    {
        header('Location: index.php?action=welcome');
    }
    else
    {
        $error = 50;
        header('Location: index.php?action=welcome&error='.$error);
    }
}
else
{
    $error = 60;
    header('Location: index.php?action=welcome&error='.$error);
}


