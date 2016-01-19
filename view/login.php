<div id="logindiv">
    <?php
    include 'controller/variables.php';

        if(!isset($_SESSION['CurrentUser']))
        {   ?>
            <h3  class="h3" >Login</h3>
            <form id="login" action="controller/loginuser.php" method="post">
                <label for="LoginUsername">Benutzername</label>
                <input id="LoginUsername" name="LoginUsername" required="required">

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
            <h3 class="h3"><?php mysqli_fetch_assoc($user) ?></h3>
    <?php
        }
    ?>


</div>