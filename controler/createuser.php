<?php

require_once '../include/GoogleAuthenticator/PHPGangsta/GoogleAuthenticator.php';
require_once '../include/db_connection.inc';

$ga = new PHPGangsta_GoogleAuthenticator();

$loginState = isset($_SESSION['LoginState']) ? $_SESSION['LoginState'] : 0;
$selectedPassword = isset($_SESSION['SelectedPassword']) ? $_SESSION['SelectedPassword'] : null;
$repeatPassword = isset($_SESSION['RepeatPassword']) ? $_SESSION['RepeatPassword'] : null;
$selectedUsername = isset($_SESSION['SelectedUsername']) ? $_SESSION['SelectedUsername'] : null;
$selectedLastName = isset($_SESSION['SelectedLastName']) ? $_SESSION['SelectedLastName'] : null;
$selectedFirstName = isset($_SESSION['SelectedFirstName']) ? $_SESSION['SelectedFirstName'] : null;
$googleAuthenticatorSecret = isset($_SESSION['GoogleAuthenticatorSecret']) ? $_SESSION['GoogleAuthenticatorSecret'] : null;
$googleAuthenticatorCode = isset($_SESSION['GoogleAuthenticatorCode']) ? $_SESSION['GoogleAuthenticatorCode'] : null;

$checkResult = $ga->verifyCode($googleAuthenticatorSecret, $googleAuthenticatorCode, 2);    // 2 = 2*30sec clock tolerance

if ($checkResult && preg_match("TODO", $selectedPassword)) {
    $db = $_SESSION['DBConnection'];

    $options = [
        'cost' => 42,
        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    ];

    $hashedPassword = password_hash($selectedPassword, PASSWORD_BCRYPT, $options) . "\n";

    $query = "INSERT INTO users(username, firstname, lastname, password, secret) VALUES($selectedUsername, $selectedFirstName, $selectedLastName, $hashedPassword, $googleAuthenticatorSecret)";

    mysqli_query($db, $query);

    echo 'Account was successfully created';
} else {
    echo 'Google Authentication oder das Passwort war falsch!';
}