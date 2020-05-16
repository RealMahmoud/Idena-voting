<?php
session_start();
include("_config.php");
if (!empty($_GET['token'])){
  $_SESSION["token"] = $_GET['token'];
}
if (empty($_POST['desc'])){
die('Error missing description');
}
if (empty($_POST['amount'])){
die('Error missing amount');
}
if (empty($_POST['type'])){
die('Error missing type');
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

$sql = "SELECT * FROM `auth` WHERE `token` = '".$_SESSION["token"]."';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $addr = $row['addr'];

}}
if ($_POST['type'] == 'poll'){
  $sql = "INSERT INTO `polls`( `pdesc`, `addr`) VALUES ('".$_POST['desc']."','".$addr."')";
  $result = $conn->query($sql);
}
if ($_POST['type'] == 'project'){
  $sql = "INSERT INTO `projects`( `pdesc`, `addr`,`amount`) VALUES ('".$_POST['desc']."','".$addr."','".$_POST['amount']."')";

  $result = $conn->query($sql);
}
?>
added :)
