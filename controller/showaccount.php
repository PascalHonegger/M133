<?php

require_once 'include/GoogleAuthenticator/PHPGangsta/GoogleAuthenticator.php';
require_once 'include/db_connection.inc';
require 'variables.php';

$query = 'SELECT * FROM account WHERE user_ID = ' . $user['user_ID'];

$result = mysqli_query($db, $query);

while($row = mysqli_fetch_array($result))
{
    $balance = $row['balance'];
    $type = $row['type'];
    $name = $row['acc_name'];

    include "view/showaccount.php";
}