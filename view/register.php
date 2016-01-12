<h1>Registrieren</h1>
<form action="../controler/createuser.php" method="post">
<table id="registertable">
    <tr>
        <td>
            <label for="SelectedUsername">Benutzername: </label>
        </td>
        <td>
            <input id="SelectedUsername" name="SelectedUsername">
        </td>
        <td></td>
        <td rowspan="4">
            <?php

            require_once '../include/GoogleAuthenticator/PHPGangsta/GoogleAuthenticator.php';

            $ga = new PHPGangsta_GoogleAuthenticator();

            $secret = $ga->createSecret();

            $qrCodeUrl = $ga->getQRCodeGoogleUrl('support@paal.ch', $secret);

            echo '<image src="' . $qrCodeUrl . '"">';

            ?>
        </td>
    </tr>
    <tr>
        <td>
            <label for="SelectedFirstName">Vorname: </label>
        </td>
        <td>
            <input id="SelectedFirstName" name="SelectedFirstName" required="required">
        </td>
    </tr>
    <tr>
        <td>
            <label for="SelectedLastName">Nachname: </label>
        </td>
        <td>
            <input id="SelectedLastName" name="SelectedLastName" required="required">
        </td>
    </tr>
    <tr>
        <td>
            <label for="SelectedPassword">Passwort: </label>
        </td>
        <td>
            <input id="SelectedPassword" name="SelectedPassword" required="required">
        </td>
    </tr>
    <tr>
        <td>
            <label for="RepeatPassword">Passwort wiederholen: </label>
        </td>
        <td>
            <input id="RepeatPassword" name="RepeatPassword" required="required">
        </td>
        <td>
            <label for="GoogleAuthenticatorCode">Generierter Code: </label>
        </td>
        <td>
            <input id="GoogleAuthenticatorCode" name="GoogleAuthenticatorCode" required="required">
        </td>
    </tr>
    <tr>
        <td>
            <input type="submit">
        </td>
        <td>
            <input type="reset">
        </td>
        <td>
            <label for="GoogleAuthenticatorSecret">Secret: </label>
        </td>
        <td>
            <input id="GoogleAuthenticatorSecret" name="GoogleAuthenticatorSecret" value="<?php echo $secret; ?>"
                   readonly>
        </td>
    </tr>

    </form>
</table>