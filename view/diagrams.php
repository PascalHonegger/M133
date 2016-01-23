<?php
require_once 'include/db_connection.inc';
require 'controller/variables.php';

if($user == null)
{
    header('Location: index.php?action=register');
}

$query = 'SELECT * FROM account WHERE user_ID = ' . $user['user_ID'];

$result = mysqli_query($db, $query);

?>
<form action="controller/diagrams.php" method="post">
    <label for="account">Account: </label>
    <select id="account" name="account">
        <?php
        while ($row = mysqli_fetch_array($result)) {
            $balance = $row['balance'];
            $type = $row['type'];
            $name = $row['acc_name'];
            $id = $row['acc_ID'];

            echo '<option value="' . $id . '">' . $name . '</option>';
        }
        ?>
    </select>

    <input type="submit">