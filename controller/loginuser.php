<?php

require_once '../include/GoogleAuthenticator/PHPGangsta/GoogleAuthenticator.php';
require_once '../include/db_connection.inc';
require 'variables.php';

$query = 'SELECT * FROM user WHERE username = ? LIMIT 1';

$stmt = mysqli_prepare($db, $query);

$stmt->bind_param('s',$username);

$stmt->execute();

$result = $stmt->get_result();

$user = mysqli_fetch_array($result);

$ga = new PHPGangsta_GoogleAuthenticator();

$checkResult = $ga->verifyCode($user['secret'], $googleAuthenticatorCode, 2); // 2 = 2*30sec clock tolerance

$passwordCorrect = password_verify($password, $user['password']);

if ($checkResult && $passwordCorrect) {
    $_SESSION['CurrentUser'] = $user;
    header('Location: ../index.php?action=welcome');
} else {
    $error = 132;
    header('Location: ../index.php?action=welcome&error='.$error);
}