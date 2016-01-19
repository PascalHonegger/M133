<div id="logindiv">
<<<<<<< Updated upstream
    <h3>Login</h3>
    <form id="login" action="controller/loginuser.php" method="post">
        <label for="LoginUsername">Benutzername</label>
        <input id="LoginUsername" name="LoginUsername" required="required">
=======
    <?php
        if(!isset($_SESSION['CurrentUser']))
        {   ?>
            <h3  class="h3" >Login</h3>
            <form id="login" action="../controler/createuser.php" method="post">
                <label for="LoginUsername">Benutzername</label>
                <input id="LoginUsername" name="LoginUsername" required="required">
>>>>>>> Stashed changes

                <label for="LoginPassword">Passwort</label>
                <input id="LoginPassword" name="LoginPassword" type="password" required="required">

                <label for="LoginGoogleAuthenticatorCode">Authenticator-Code</label>
                <input id="LoginGoogleAuthenticatorCode" name="LoginGoogleAuthenticatorCode" required="required">

                <input type="submit">
            </form>
    <?php
        }
        else
        { ?>
            <h3 class="h3"><?php mysqli_fetch_assoc($_SESSION['CurrentUser']['username']) ?></h3>
    <?php
        }
    ?>


</div>