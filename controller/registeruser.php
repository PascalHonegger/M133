<?php

require_once dirname(__FILE__).'/../include/GoogleAuthenticator/PHPGangsta/GoogleAuthenticator.php';
require_once dirname(__FILE__).'/../include/db_connection.inc';

if (isset($_SESSION['CurrentUser'])) {
    header('Location: '.dirname(__FILE__).'/../index.php');
}

$ga = new PHPGangsta_GoogleAuthenticator();

$selectedPassword = isset($_POST['SelectedPassword']) ? $_POST['SelectedPassword'] : null;
$repeatPassword = isset($_POST['RepeatPassword']) ? $_POST['RepeatPassword'] : null;
$selectedUsername = isset($_POST['SelectedUsername']) ? $_POST['SelectedUsername'] : null;
$selectedLastName = isset($_POST['SelectedLastName']) ? $_POST['SelectedLastName'] : null;
$selectedFirstName = isset($_POST['SelectedFirstName']) ? $_POST['SelectedFirstName'] : null;
$googleAuthenticatorSecret = isset($_POST['GoogleAuthenticatorSecret']) ? $_POST['GoogleAuthenticatorSecret'] : null;
$googleAuthenticatorCode = isset($_POST['GoogleAuthenticatorCode']) ? $_POST['GoogleAuthenticatorCode'] : null;

$passwordsMatch = $repeatPassword == $selectedPassword;

$checkResult = $ga->verifyCode($googleAuthenticatorSecret, $googleAuthenticatorCode, 2);    // 2 = 2*30sec clock tolerance

$correctPassword = preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}/', $selectedPassword);

if ($passwordsMatch && $checkResult && $correctPassword) {
    $db = $_SESSION['DBConnection'];

    $options = [
        'cost' => 11,
        'salt' => $googleAuthenticatorSecret . 'i<34u2'
    ];

    $hashedPassword = password_hash($selectedPassword, PASSWORD_BCRYPT, $options);

    $query = "INSERT INTO users(username, firstname, lastname, password, secret) VALUES('$selectedUsername', '$selectedFirstName', '$selectedLastName', '$hashedPassword', '$googleAuthenticatorSecret')";

    mysqli_query($db, $query);

    echo 'Account was successfully created! - <a href="../index.php" >zurück</a>';
} else {
    header('Location: '.dirname(__FILE__).'/../index.php?action=registrationfailed');
}