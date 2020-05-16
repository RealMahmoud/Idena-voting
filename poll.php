<?php
session_start();
include("_config.php");
if (!empty($_GET['token'])){
  $_SESSION["token"] = $_GET['token'];
}
if (empty($_GET['id'])){
  die("404");
}
if(!empty($_SESSION["token"])) {
$sql = "SELECT * FROM `auth` WHERE `token` = '".$_SESSION["token"]."';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $auth   = $row['authenticated'];

if ($auth == 0){
  header("location:login.php");
}
}}
;}
if (empty($_SESSION["token"])){
    header("location:login.php");
}

$sql = "SELECT * FROM `polls` WHERE `id` = '".$_GET["id"]."';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {



?>




<h3><?php echo  $row['pdesc'] ?></h3>
<form action="vote.php" method="GET">
Yes: <input type="radio" name="vote" value="0" checked><br>
No: <input type="radio" name="vote" value="1" >
<input type="submit" value="Vote">
</form>
<?php }} ?>
