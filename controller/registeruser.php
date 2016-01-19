<?php

require_once '../include/GoogleAuthenticator/PHPGangsta/GoogleAuthenticator.php';
require_once '../include/db_connection.inc';
require 'variables.php';

$ga = new PHPGangsta_GoogleAuthenticator();

$error = 0;

if ($repeatPassword != $selectedPassword) {
    $error = 1;
}

if (!$ga->verifyCode($googleAuthenticatorSecret, $googleAuthenticatorCode, 2)) {
    $error = 2;
}

if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}/', $selectedPassword)) {
    $error = 3;
}

if ($error == 0) {
    $db = $_SESSION['DBConnection'];

    $options = [
        'cost' => 11,
        'salt' => $googleAuthenticatorSecret . 'i<34u2'
    ];

    $hashedPassword = password_hash($selectedPassword, PASSWORD_BCRYPT, $options);

    $query = "INSERT INTO user(username, firstname, lastname, password, secret) VALUES('$selectedUsername', '$selectedFirstName', '$selectedLastName', '$hashedPassword', '$googleAuthenticatorSecret')";

    mysqli_query($db, $query);

    echo 'Account was successfully created! - <a href="../index.php" >zurück</a>';
} else {
    header('Location: ../index.php?action=register&error=' . $error);
}