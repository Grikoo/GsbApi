<?php
$timer = time();

?>
<html>
<form action="/GsbApi/token.php" method="post">
<label for="user">Login : </label>
<input type="text" placeholder="user" name="user" required >
<label for="pwd">Password : </label>
<input type="password" placeholder="pwd" name="pwd" required >
<input type="hidden" name="timer" value="<?php echo $timer ;?>" > 
<input type="submit" value="Envoyer">
</form>
</html>