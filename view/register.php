<h1>Registrieren</h1>
<form action="../controler/registeruser.php" method="post">
    <table id="registertable">
        <tr>
            <td>
                <label for="SelectedUsername">Benutzername: </label>
            </td>
            <td>
                <input id="SelectedUsername" name="SelectedUsername" required="required">
            </td>
            <td></td>
            <td rowspan="4">
                <?php

                require_once 'include/GoogleAuthenticator/PHPGangsta/GoogleAuthenticator.php';

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
                <input id="SelectedPassword" name="SelectedPassword" required="required" type="password">
            </td>
        </tr>
        <tr>
            <td>
                <label for="RepeatPassword">Passwort wiederholen: </label>
            </td>
            <td>
                <input id="RepeatPassword" name="RepeatPassword" required="required" type="password">
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
    </table>
</form>

<?php

if (isset($_GET['action']) && $_GET['action'] == 'registrationfailed') {
    echo "<p style='color: red;'>Registrierung fehlgeschlagen! Bitte versuchen Sie es erneut!</p>";
}