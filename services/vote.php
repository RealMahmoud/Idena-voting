<?php
session_start();

include(dirname(__FILE__)."/../common/_protected.php");
header('Content-Type: application/json');

$id = $conn->real_escape_string($_POST['id']);
$vote = $conn->real_escape_string($_POST['vote']);
$type = $conn->real_escape_string($_POST['type']);

$sql = "SELECT * FROM `votes` WHERE `addr` = '".$_SESSION["addr"]."' AND `pid` = '".$id."' AND `type` = '".$type."' LIMIT 1;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
          echo '{"success":false, "data": "You have already voted"}';
          }
} else {



  $sql = "SELECT * FROM `".$type."s` WHERE `id` = '".$id."' LIMIT 1;";
  $result3 = $conn->query($sql);
  if ($result3->num_rows > 0) {
  while($row2 = $result3->fetch_assoc()) {
    if(Date(strtotime('now')) > Date(strtotime($row2['endtime']))&&isset($_SESSION["addr"])){
    die('{"status": "ended", "data": "0"}');
  }else{
      $sql = "INSERT INTO `votes`(`pid`, `addr`, `vote`,`type`) VALUES ('".$id."','".$_SESSION["addr"]."','".$vote."','".$type."');";
      $result = $conn->query($sql);
      echo '{"success":true, "data": "Vote casted successfully"}';
    }
}}



}
?>
