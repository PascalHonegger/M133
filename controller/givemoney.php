<?php

require_once '../include/db_connection.inc';
require 'variables.php';

$query = 'UPDATE account SET balance= balance + ' . $amount . ' WHERE acc_ID=' . $to;

mysqli_query($db, $query);

$query = 'UPDATE account SET balance = balance - ' . $amount . ' WHERE acc_ID=' . $from;

mysqli_query($db, $query);

header('Location: ../index.php?action=&error=' . $error);