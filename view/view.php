<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Paal Financial Services</title>
    <meta name="description" content="Paal Financial Services">
    <meta name="author" content="PaAl">
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/scripts.js"></script>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <style type="text/css">
        ${demo.css}
    </style>

</head>
<body>
<div id="container">
    <div id="header">
        <div id="headerlogo">

        </div>
        <div id="navigation">
            <ul id="navlist">
                <a href="?action=welcome">
                    <li class="navbutton">Konten</li>
                </a>
                <a href="?action=finances">
                    <li class="navbutton">Finanzplanung</li>
                </a>
                <a href="?action=givemoney">
                    <li class="navbutton">Überweisungen</li>
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
                } elseif ($action == 'welcome' && $user != null) {
                    include 'controller/showaccount.php';
                    include 'view/createaccount.php';
                } elseif ($action == 'welcome') {
                    include 'register.php';
                }   elseif ($action == 'finances') {
                    include 'controller/diagrams.php';
                } elseif ($action == 'givemoney') {
                    include 'view/givemoney.php';
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