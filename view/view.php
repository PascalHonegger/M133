<div id="container">
    <div id="header">
        <div id="headerlogo">

        </div>
        <div id="navigation">
            <ul id="navlist">
                <a href="">
                    <li class="navbutton">Budget</li>
                </a>
                <a href="">
                    <li class="navbutton">Bank</li>
                </a>
                <a href="">
                    <li class="navbutton">Login</li>
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
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'register' || $_GET['action'] == 'registrationfailed')
                {
                    include 'register.php';
                }
            } else {
                if (isset($_SESSION['CurrentUser']))
                {
                    //include Money.php
                } else {
                    include 'register.php';
                }
            }
            ?>

        </div>
    </div>
    <div id="footer">
        <p>#Sinnloser Footer</p>
    </div>

</div>