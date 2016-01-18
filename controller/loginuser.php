<?php

require_once dirname(__FILE__).'/../include/GoogleAuthenticator/PHPGangsta/GoogleAuthenticator.php';
require_once dirname(__FILE__).'/../include/db_connection.inc';

$password = isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : null;
$username = isset($_POST['LoginUsername']) ? $_POST['LoginUsername'] : null;
$googleAuthenticatorCode = isset($_POST['LoginGoogleAuthenticatorCode']) ? $_POST['LoginGoogleAuthenticatorCode'] : null;

$db = $_SESSION['DBConnection'];

$query = "SELECT * FROM users WHERE username = '$username' LIMIT 1";

$result = mysqli_query($db, $query);

$user = mysqli_fetch_array($result);

$ga = new PHPGangsta_GoogleAuthenticator();

$checkResult = $ga->verifyCode($user['secret'], $googleAuthenticatorCode, 2);    // 2 = 2*30sec clock tolerance

$passwordCorrect = password_verify($password, $user['password']);

if ($checkResult && $passwordCorrect) {
    $_SESSION['CurrentUser'] = $user;
    echo "You are logged in!!!";
    header('Location: '.dirname(__FILE__).'/../index.php');
} else {
    echo "SomethingIsWrong.exe";
}