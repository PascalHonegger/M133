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
            <?php include dirname(__FILE__).'/login.php'; ?>
        </div>
        <div id="content">
            <?php
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'register' || $_GET['action'] == 'registrationfailed')
                {
                    include dirname(__FILE__).'/register.php';
                }
            } else {
                if (isset($_SESSION['CurrentUser']))
                {
                    include dirname(__FILE__).'/../controller/showmoney.php';
                } else {
                    include dirname(__FILE__).'/register.php';
                }
            }
            ?>

        </div>
    </div>
    <div id="footer">
        <p>#Sinnloser Footer</p>
    </div>

</div>