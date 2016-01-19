<?php
/**
 * Created by PhpStorm.
 * User: Alain
 * Date: 19.01.2016
 * Time: 14:25
 */
include '../include/db_connection.inc';
include 'Variables.php';


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
        echo '<p>Sie haben den Account erfolgriich erstellt</p>';
    }
    else
    {
        echo '<p>FAILLL</p>';
    }
}
else
{
    echo '<p>HACKUUTRESE!</p>';
}


