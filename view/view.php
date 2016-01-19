<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Paal Financial Services</title>
    <meta name="description" content="Paal Financial Services">
    <meta name="author" content="PaAl">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js"></script>
</head>
<body>
<div id="container">
    <div id="header">
        <div id="headerlogo">

        </div>
        <div id="navigation">
            <ul id="navlist">
                <a href="">
                    <li class="navbutton">Konten</li>
                </a>
                <a href="">
                    <li class="navbutton">Finanzplanung</li>
                </a>
                <a href="">
                    <li class="navbutton">Account</li>
                </a>
            </ul>
        </div>

    </div>
    <div id="maincontent">
        <div id="menu">
            <?php include 'login.php'; ?>
        </div>
        <div id="content">
            <?php
            require 'controller/variables.php';

            if ($action != null) {
                if ($action == 'register') {
                    include 'register.php';
                } elseif ($action == 'welcome') {
                    include 'controller/showaccount.php';
                }
                 elseif ($action == 'newacc') {
                    include 'view/createaccount.php';
                }

            }
            else {
                if ($user != null) {
                    include 'controller/showaccount.php';
                } else {
                    include 'register.php';
                }
            }
                ?>
            </div>
        </div>
        <div id="footer">
            <p>©PAAL FINANCIAL SERVICES</p>
        </div>
</div>
</body>
</html>