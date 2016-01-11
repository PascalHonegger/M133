<?php

require_once '../include/GoogleAuthenticator/PHPGangsta/GoogleAuthenticator.php';

$ga = new PHPGangsta_GoogleAuthenticator();


$secret = $ga->createSecret();

$qrCodeUrl = $ga->getQRCodeGoogleUrl('pascal.honegger@test.ch', $secret);

echo '<image src="' . $qrCodeUrl . '"">';

echo '

<form action="createuser.php" method="post">
    <input id="GoogleAuthenticatorCode" name="GoogleAuthenticatorCode">
    <input id="GoogleAuthenticatorSecret" name="GoogleAuthenticatorSecret" value="' . $secret . '" disabled>
    <input type="submit">
</form>

';