<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$selectedPassword = isset($_POST['SelectedPassword']) ? $_POST['SelectedPassword'] : null;
$repeatPassword = isset($_POST['RepeatPassword']) ? $_POST['RepeatPassword'] : null;
$selectedUsername = isset($_POST['SelectedUsername']) ? $_POST['SelectedUsername'] : null;
$selectedLastName = isset($_POST['SelectedLastName']) ? $_POST['SelectedLastName'] : null;
$selectedFirstName = isset($_POST['SelectedFirstName']) ? $_POST['SelectedFirstName'] : null;
$googleAuthenticatorSecret = isset($_POST['GoogleAuthenticatorSecret']) ? $_POST['GoogleAuthenticatorSecret'] : null;
$googleAuthenticatorCode = isset($_POST['GoogleAuthenticatorCode']) ? $_POST['GoogleAuthenticatorCode'] : null;
$password = isset($_POST['LoginPassword']) ? $_POST['LoginPassword'] : null;
$username = isset($_POST['LoginUsername']) ? $_POST['LoginUsername'] : null;
$from = isset($_POST['from']) ? $_POST['from'] : null;
$to = isset($_POST['to']) ? $_POST['to'] : null;
$amount = isset($_POST['amount']) ? $_POST['amount'] : null;
$type = isset($_POST['type']) ? $_POST['type'] : null;
$accountname = isset($_POST['accountname']) ? $_POST['accountname'] : null;
$accounttype = isset($_POST['accounttype']) ? $_POST['accounttype'] : null;
$limit = isset($_POST['limit']) ? $_POST['limit'] : null;


if(isset($_POST['account']))
{
    $account = $_POST['account'];
}elseif(isset($_GET['account']))
{
    $account = $_GET['account'];
}else{
    $account = null;
}

$action = isset($_GET['action']) ? $_GET['action'] : null;
$error = isset($_GET['error']) ? $_GET['error'] : null;

$user = isset($_SESSION['CurrentUser']) ? $_SESSION['CurrentUser'] : null;
$db = isset($_SESSION['DBConnection']) ? $_SESSION['DBConnection'] : null;

$passwordRegularExpression = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@!%*?&_-])[A-Za-z\d$@!%*?&_-]{8,}/';