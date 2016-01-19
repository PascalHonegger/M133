<?php
/**
 * Created by PhpStorm.
 * User: Alain
 * Date: 19.01.2016
 * Time: 14:25
 */
if(isset($_SESSION))
{


include 'controller/variables.php';

?>
<form action="controller/createaccount.php" method="post">
    <label for="accountname">Name: </label ><input type="text" name="accountname">
    <label for="accounttype">Name: </label > <select name="accounttype" size="1">
                                                <option>Sparkonto</option>
                                                <option>Privatkonto</option>
                                                <option>Jugendkonto</option>
                                                <option>Säule 3</option>
                                            </select>
    <label for="limit">Name: </label ><input type="text" name="limit">
</form>
<?php
}
else
{
    echo "<p>hacckuuur!!</p>";
}
?>