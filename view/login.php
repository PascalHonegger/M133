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

                <label for="GoogleAuthenticatorCode">Authenticator-Code</label>
                <input id="GoogleAuthenticatorCode" name="GoogleAuthenticatorCode" required="required">

                <input type="submit">
            </form>
    <?php
        }
        else
        { ?>
            <h3 class="h3">Hallo <?php echo $user['username'] ?></h3>

            <a href="view/logout.php">Logout</a>
    <?php
        }
    ?>


</div>