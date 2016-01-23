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
    <form action="controller/givemoney.php" method="post" id="chosenForm">
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
    <label for="type">Typ</label>
        <select id="type" name="type">
            <option value="Miete">Miete</option>
            <option value="Haushalt">Haushalt</option>
            <option value="Freizeit">Freizeit</option>
            <option value="Online">Online</option>
            <option value="Einkaufen">Einkaufen</option>
            <option value="Reisen">Reisen</option>
            <option value="Gesundheit">Gesundheit</option>
            <option value="Steuern & Versicherungen">Steuern & Versicherungen</option>
            <option value="Ferien">Ferien</option>
            <option value="Diverses">Diverses</option>
        </select>

    <input type="submit">

</form>

<?php

if ($error != 0) {
    echo '<p style="color: red;">Fehler bei der Überweisung (Fehlercode ' .$error. ')!</p>';
}