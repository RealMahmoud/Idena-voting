<?php
session_start();
include("_config.php");
if (!empty($_GET['token'])){
  $_SESSION["token"] = $_GET['token'];
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
?>



Logout?
<form action="logout.php" method="GET">

<input type="submit" value="LOG OUT">
</form>
