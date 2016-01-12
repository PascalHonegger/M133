<?php

require_once '../include/GoogleAuthenticator/PHPGangsta/GoogleAuthenticator.php';
require_once '../include/db_connection.inc';

$ga = new PHPGangsta_GoogleAuthenticator();

$selectedPassword = isset($_POST['SelectedPassword']) ? $_POST['SelectedPassword'] : null;
$repeatPassword = isset($_POST['RepeatPassword']) ? $_POST['RepeatPassword'] : null;
$selectedUsername = isset($_POST['SelectedUsername']) ? $_POST['SelectedUsername'] : null;
$selectedLastName = isset($_POST['SelectedLastName']) ? $_POST['SelectedLastName'] : null;
$selectedFirstName = isset($_POST['SelectedFirstName']) ? $_POST['SelectedFirstName'] : null;
$googleAuthenticatorSecret = isset($_POST['GoogleAuthenticatorSecret']) ? $_POST['GoogleAuthenticatorSecret'] : null;
$googleAuthenticatorCode = isset($_POST['GoogleAuthenticatorCode']) ? $_POST['GoogleAuthenticatorCode'] : null;

$checkResult = $ga->verifyCode($googleAuthenticatorSecret, $googleAuthenticatorCode, 2);    // 2 = 2*30sec clock tolerance

$correctPassword = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}/', $selectedPassword);

if ($checkResult && $correctPassword) {
    $db = $_SESSION['DBConnection'];

    $options = [
        'cost' => 11,
        'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
    ];

    $hashedPassword = password_hash($selectedPassword, PASSWORD_BCRYPT, $options) . "\n";

    $query = "INSERT INTO users(username, firstname, lastname, password, secret) VALUES('$selectedUsername', '$selectedFirstName', '$selectedLastName', '$hashedPassword', '$googleAuthenticatorSecret')";

    mysqli_query($db, $query);

    echo 'Account was successfully created! - <link href="../view/login.php" content="anmelden">';
} else {
    echo 'Google Authentication oder das Passwort war falsch!';
}