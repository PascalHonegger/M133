<h1>Registrieren</h1>
<table id="registertable">
    <form action="../controler/createuser.php" method="post">
    <tr>
        <td>
            <label for="SelectedUsername">Benutzername: </label>
        </td>
        <td>
            <input id="SelectedUsername" name="SelectedUsername" ></br>
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
            <input id="SelectedFirstName" name="SelectedFirstName" >
        </td>
    </tr>
    <tr>
        <td>
            <label for="SelectedFirstName">Nachname: </label>
        </td>
        <td>
            <input id="SelectedLastName" name="SelectedLastName" >
        </td>
    </tr>
    <tr>
        <td>
            <label for="SelectedFirstName">Passwort: </label>
        </td>
        <td>
            <input id="SelectedPassword" name="SelectedPassword" >
        </td>
    </tr>
    <tr>
        <td>
            <label for="SelectedFirstName">Passwort wiederholen: </label>
        </td>
        <td>
            <input id="RepeatPassword" name="RepeatPassword" >
        </td>
        <td>
            <label for="GoogleAuthenticatorCode">Generierter Code: </label>
        </td>
        <td>
            <input id="GoogleAuthenticatorCode" name="GoogleAuthenticatorCode">
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