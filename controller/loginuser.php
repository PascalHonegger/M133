<?php

require_once '../include/GoogleAuthenticator/PHPGangsta/GoogleAuthenticator.php';
require_once '../include/db_connection.inc';
require 'variables.php';

$query = "SELECT * FROM user WHERE username = '$username' LIMIT 1";

$result = mysqli_query($db, $query);

$user = mysqli_fetch_array($result);

$ga = new PHPGangsta_GoogleAuthenticator();

$checkResult = $ga->verifyCode($user['secret'], $googleAuthenticatorCode, 2); // 2 = 2*30sec clock tolerance

$passwordCorrect = password_verify($password, $user['password']);

if ($checkResult && $passwordCorrect) {
    $_SESSION['CurrentUser'] = $user;
    header('Location: ../index.php?action=welcome');
} else {
    echo "SomethingIsWrong.exe";
    var_dump($checkResult);
    var_dump($passwordCorrect);
    var_dump($result);
    var_dump($user);
}