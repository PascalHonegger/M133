<?php

require_once '../include/GoogleAuthenticator/PHPGangsta/GoogleAuthenticator.php';
require_once '../include/db_connection.inc';

$ga = new PHPGangsta_GoogleAuthenticator();

$loginState = isset($_SESSION['LoginState']) ? $_SESSION['LoginState'] : 0;

$checkResult = $ga->verifyCode($_POST['GoogleAuthenticatorSecret'], $_POST['GoogleAuthenticatorCode'], 2);    // 2 = 2*30sec clock tolerance

if ($checkResult) {
    $db = $_SESSION['DBConnection'];

    $query = "INSERT INTO users VALUES ";

    mysqli_query($db, $query);

    mysqli_fetch_assoc($results);

    echo 'Account was successfully created';
} else {
    echo 'Google Authentication failed! ';
}