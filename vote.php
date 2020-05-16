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
if (empty($_GET['type'])){
die('Error missing type');
}
if (empty($_GET['id'])){
die('Error missing id');
}
if (!isset($_GET['vote'])){
die('Error missing vote');
}
$sql = "SELECT * FROM `auth` WHERE `token` = '".$_SESSION["token"]."';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $addr = $row['addr'];

}}

$sql = "SELECT * FROM `votes` WHERE `addr` = '".$addr."' AND `pid` = '".$_GET['id']."';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
  die('Already voted');

}}
$sql = "INSERT INTO `votes`(`pid`, `addr`, `vote`,`type`) VALUES ('".$_GET['id']."','".$addr."','".$_GET['vote']."','".$_GET['type']."');";
$result = $conn->query($sql);
?>



Thanks for votting :)
