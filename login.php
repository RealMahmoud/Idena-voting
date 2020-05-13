<?php
session_start();

if(!empty($_SESSION["addr"])) {
header("location:index.php");
die();
}
else {
//something?
//i need to see how this works so we know what to do and where to put what
}
include("_config.php");

?>
<form action="dna://signin/v1" method="GET">
<input type="hidden" id="nonce_endpoint" name="nonce_endpoint" value="<?php echo $url;?>/start-session.php">
<input type="hidden" id="token" name="token" value="<?php echo GUID(); ?>">
<input type="hidden" id="callback_url" name="callback_url" value="<?php echo $url;?>/index.php">
<input type="hidden" id="authentication_endpoint" name="authentication_endpoint" value="<?php echo $url;?>/auth.php">
<input type="submit" value="Sign-In with Idena">
</form>
