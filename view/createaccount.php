<?php
if(isset($_SESSION))
{


include 'controller/variables.php';

?>
<form action="controller/createaccount.php" method="post">
    <label for="accountname">Name: </label ><input type="text" name="accountname">
    <label for="accounttype">Kontotyp: </label > <select name="accounttype" size="1">
                                                <option>Sparkonto</option>
                                                <option>Privatkonto</option>
                                                <option>Jugendkonto</option>
                                                <option>Säule 3</option>
                                            </select>
    <label for="limit">Limit: </label ><input type="text" name="limit">
    <input type="submit"/>
</form>
<?php
}
else
{
    echo "<p>hacckuuur!!</p>";
}
?>