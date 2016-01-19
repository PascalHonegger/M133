<?php

require_once '../include/GoogleAuthenticator/PHPGangsta/GoogleAuthenticator.php';
require_once '../include/db_connection.inc';
require 'variables.php';

$query = 'SELECT * FROM account WHERE acc_ID=' . $to;

$result = mysqli_query($db, $query);

if ($result) {
    echo "ERRÖRR";
}