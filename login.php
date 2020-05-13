<?php
session_start();

if(!empty($_SESSION["addr"])) {
header("location:index.php");
die();
} else {

}
include("_config.php");

function GUID()
{
   if (function_exists('com_create_guid') === true)
   {
       return trim(com_create_guid(), '{}');
   }

   return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}
?>
<form action="dna://signin/v1" method="get">

<input type="hidden" id="nonce_endpoint" name="nonce_endpoint" value="<?php echo $url;?>/start-session.php">
 <input type="hidden" id="token" name="token" value="<?php echo GUID(); ?>">
   <input type="hidden" id="callback_url" name="callback_url" value="<?php echo $url;?>/index.php">
    <input type="hidden" id="authentication_endpoint" name="authentication_endpoint" value="<?php echo $url;?>/auth.php">



  <label for="welcome">Please Login :)</label><br>
  <input type="submit" value="Login">
</form>
