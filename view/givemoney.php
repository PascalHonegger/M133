<?php

require_once 'include/db_connection.inc';
require 'variables.php';

$query = 'SELECT * FROM account WHERE user_ID = ' . $user['user_ID'];

$result = mysqli_query($db, $query);

?>
<form action="../controller/givemoney.php">
    <label for="from">Von</label>
    <select id="from" name="from">
        <?php
        while ($row = mysqli_fetch_array($result)) {
            $balance = $row['balance'];
            $type = $row['type'];
            $name = $row['acc_name'];
            $id = $row['acc_ID'];

            echo '<option value="' . $id . '">' . $name . ' (' . $balance . ')</option>';
        }
        ?>
    </select>

    <label for="to">Nach</label><input id="to" name="to">

    <label for="amount">Betrag</label><input id="amount" name="amount">

    <input type="submit">

</form>