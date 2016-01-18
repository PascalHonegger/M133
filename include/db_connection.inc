<?php

session_start();

$user = "paal_admin";
$pass = "paal_password";
$DBName = "paal_db";
$ServerName = "localhost";

// DB verbinden
$DB = mysqli_connect($ServerName, $user, $pass, $DBName);

if ($DB->connect_errno)
{
    die ('Fehler: ' . $DB->connect_errno);
}
else
{
    $_SESSION['DBConnection'] = $DB;
}