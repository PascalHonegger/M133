<?php

require_once '../include/GoogleAuthenticator/PHPGangsta/GoogleAuthenticator.php';

$ga = new PHPGangsta_GoogleAuthenticator();

$secret = $ga->createSecret();

$qrCodeUrl = $ga->getQRCodeGoogleUrl('pascal.honegger@test.ch', $secret);

echo '<image src="' . $qrCodeUrl . '"">';

echo '

<form action="../controler/createuser.php" method="post">
    <label for="GoogleAuthenticatorCode">Generierter Code</label><input id="GoogleAuthenticatorCode" name="GoogleAuthenticatorCode"></br>
    <label for="GoogleAuthenticatorSecret">Secret</label></label><input id="GoogleAuthenticatorSecret" name="GoogleAuthenticatorSecret" value="' . $secret . '" disabled></br>
    <label for="SelectedUsername">Benutzername</label><input id="SelectedUsername" name="SelectedUsername" ></br>
    <label for="SelectedFirstName">Vorname</label><input id="SelectedFirstName" name="SelectedFirstName" ></br>
    <label for="SelectedFirstName">Nachname</label><input id="SelectedLastName" name="SelectedLastName" ></br>
    <label for="SelectedFirstName">Passwort</label><input id="SelectedPassword" name="SelectedPassword" ></br>
    <label for="SelectedFirstName">Passwort wiederholen</label><input id="RepeatPassword" name="RepeatPassword" ></br>
    <input type="submit">

</form>

';