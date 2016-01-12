<?php

$loginState = isset($_SESSION['CurrentUser']) ? $_SESSION['CurrentUser'] : null;
$selectedPassword = isset($_POST['SelectedPassword']) ? $_POST['SelectedPassword'] : null;
$repeatPassword = isset($_POST['RepeatPassword']) ? $_POST['RepeatPassword'] : null;
$selectedUsername = isset($_POST['SelectedUsername']) ? $_POST['SelectedUsername'] : null;
$selectedLastName = isset($_POST['SelectedLastName']) ? $_POST['SelectedLastName'] : null;
$selectedFirstName = isset($_POST['SelectedFirstName']) ? $_POST['SelectedFirstName'] : null;
$googleAuthenticatorSecret = isset($_POST['GoogleAuthenticatorSecret']) ? $_POST['GoogleAuthenticatorSecret'] : null;
$googleAuthenticatorCode = isset($_POST['GoogleAuthenticatorCode']) ? $_POST['GoogleAuthenticatorCode'] : null;

