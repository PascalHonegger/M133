<?php

require_once '../include/GoogleAuthenticator/PHPGangsta/GoogleAuthenticator.php';
require_once '../include/db_connection.inc';
require 'variables.php';

$ga = new PHPGangsta_GoogleAuthenticator();

$error = 0;

// Passwords match
if ($repeatPassword != $selectedPassword) {
    $error = 1;
}

// Google Authenticator is correct
if (!$ga->verifyCode($googleAuthenticatorSecret, $googleAuthenticatorCode, 2)) {
    $error = 2;
}

// Password is correct
if (!preg_match($passwordRegularExpression, $selectedPassword)) {
    $error = 3;
}

// Username is correct
if ($selectedUsername >= 40) {
    $error = 4;
}

// No Errors
if ($error == 0) {
    $db = $_SESSION['DBConnection'];

    $options = [
        'cost' => 11,
        'salt' => $googleAuthenticatorSecret . 'i<34u2'
    ];

    $hashedPassword = password_hash($selectedPassword, PASSWORD_BCRYPT, $options);

    $query = "INSERT INTO user(username, firstname, lastname, password, secret) VALUES('?', '?', '?', '?', '?')";

    $stmt = mysqli_prepare($db, $query);

    $stmt->bind_param('sssss',$selectedUsername, $selectedFirstName, $selectedLastName, $hashedPassword, $googleAuthenticatorSecret );

    $stmt->execute();

    $stmt->close();


    $query = "SELECT * FROM user WHERE username = '?' LIMIT 1";

    $stmt = mysqli_prepare($db, $query);

    $stmt->bind_param('s', $selectedUsername);

    $result = $stmt->get_result();

    $stmt->execute();

    $stmt->close();

    $user = mysqli_fetch_array($result);

    if(mysqli_errno($db))
    {
        $error = 126;
        header('Location: ../index.php?action=register&error='. $error);
    }

    $_SESSION['CurrentUser'] = $user;

    header('Location: ../index.php?action=welcome');
} else {
    header('Location: ../index.php?action=register&error=' . $error);
}