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
    <label for="Accounttype">Name: </label >
    <label for="limit">Name: </label ><input type="text" name="limitghgh">
</form>
<?php
}
else
{
    echo "<p>hacckuuur!!</p>";
}
?>