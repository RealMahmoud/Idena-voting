<?php
session_start();
include("_config.php");
if(!empty($_SESSION["token"])) {
$sql = "SELECT * FROM `auth` WHERE `token` = '".$_SESSION['token']."';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $auth   = $row['authenticated'];

if ($auth == 1){
  header("location:index.php");
}

}}}
//something?
//i need to see how this works so we know what to do and where to put what


$token = GUID();
?>
<form action="dna://signin/v1" method="GET">
<input type="hidden" id="nonce_endpoint" name="nonce_endpoint" value="<?php echo $url;?>/start-session.php">
<input type="hidden" id="token" name="token" value="<?php echo $token; ?>">
<input type="hidden" id="callback_url" name="callback_url" value="<?php echo $url;?>/index.php?token=<?php echo $token;?>">
<input type="hidden" id="authentication_endpoint" name="authentication_endpoint" value="<?php echo $url;?>/auth.php">
<input type="submit" value="Sign-In with Idena">
</form>
