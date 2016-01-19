<?php

require_once 'include/GoogleAuthenticator/PHPGangsta/GoogleAuthenticator.php';
require_once 'include/db_connection.inc';
require 'variables.php';

if ($user == null) {
    $user = $_SESSION['CurrentUser'];
    header('Location: ../index.php');
}

$query = 'SELECT * FROM account WHERE user_ID = ' . $user['user_ID'];

$result = mysqli_query($db, $query);

while($row = mysqli_fetch_array($result))
{
    $balance = $result['balance'];
    $type = $result['type'];

    include "view/showaccount.php?balance=$balance&type=$type";
}