<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
include(dirname(__FILE__)."/../common/protected.php");
header('Content-Type: application/json');

$id = $conn->real_escape_string($_POST['id']);
$vote = $conn->real_escape_string($_POST['vote']);
$type = $conn->real_escape_string($_POST['type']);

$sql = "SELECT * FROM `votes` WHERE `addr` = '".$addr."' AND `pid` = '".$id."' LIMIT 1;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
          echo '{"success":false, "data": "You have already voted"}';
          }
} else {
    $sql = "INSERT INTO `votes`(`pid`, `addr`, `vote`,`type`) VALUES ('".$id."','".$addr."','".$vote."','".$type."');";
    $result = $conn->query($sql);
    echo '{"success":true, "data": "Vote casted successfully"}';
}
?>
