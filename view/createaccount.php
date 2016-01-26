<?php
if(isset($_SESSION))
{


include 'controller/variables.php';

?>
<form action="controller/createaccount.php" method="post">
    <label for="accountname">Name: </label><input type="text" name="accountname" required="required">
    <label for="accounttype">Kontotyp: </label> <select name="accounttype" size="1" required="required">
                                                <option>Sparkonto</option>
                                                <option>Privatkonto</option>
                                                <option>Jugendkonto</option>
                                                <option>Säule 3</option>
                                            </select>
    <label for="limit">Limit: </label><input type="number" step="10" id="limit" name="limit" required="required">
    <input type="submit"/>
</form>
<?php
}
else
{
    echo "<p>Etwas ist schiefgelaufen!!</p>";
}
?>