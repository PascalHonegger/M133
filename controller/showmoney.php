<?php

require_once dirname(__FILE__).'/../include/db_connection.inc';


if(isset($_SESSION['CurrentUser'])){
    $user = $_SESSION['CurrentUser'];
}
else{
    header('Location: '.dirname(__FILE__).'/../index.php');
}

$db = $_SESSION['DBConnection'];

$query = 'SELECT * FROM accounts WHERE user_ID = '.$user['user_ID'];

$result = mysqli_query($db, $query);

while($row = mysqli_fetch_array($result))
{
    $balance = $result['balance'];
    $type = $result['type'];

    include dirname(__FILE__)."/../view/showaccount.php?balance=$balance&type=$type";
}