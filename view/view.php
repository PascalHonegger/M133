<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/styles.css">
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <div id="container">
        <div id="header">
            <div id="headerlogo">

            </div>
            <div id="navigation">
                <ul id="navlist">
                    <a href=""><li class="navbutton" >Budget</li></a>
                    <a href=""><li class="navbutton">Bank</li></a>
                        <a href=""><li class="navbutton">Login</li></a>
                </ul>
            </div>

        </div>
        <div id="maincontent">
            <div id="menu">
                <?php include 'login.php'; ?>
            </div>
            <div id="content">
                <?php
                if(isset($_GET['action']))
                {
                    if($_GET['action'] == "register")
                    {
                        include 'register.php';
                    }
                }
                else
                {
                    echo '<p>Hacckkkkuur::((!!!!!</p>';
                }
                ?>

            </div>
        </div>
        <div id="footer">
            <p>#Sinnloser Footer</p>
        </div>

    </div>
</body>
</html>