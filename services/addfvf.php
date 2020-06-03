<?php
session_start();
die("404");
include(dirname(__FILE__)."/../common/protected.php");
header('Content-Type: application/json');
$sql = "SELECT * FROM `accounts` WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    if($row['credits'] < 1){
      die('{"success":false}');
    }
  }}
  if(empty($conn->real_escape_string($_POST['desc']))) {
    die('{"success":false}');
  }

if(!empty($_SESSION["addr"]))
{
        if ($_POST['type'] == 'fvf'){

          $addr = $conn->real_escape_string($_SESSION["addr"]);
          $location1 = $conn->real_escape_string($_POST['location1']);
          $location2 = $conn->real_escape_string($_POST['location2']);
          $endtime= $conn->real_escape_string($_POST['endtime']);
          $pdesc = $conn->real_escape_string($_POST['desc']);
          $fundaddr = $conn->real_escape_string($_POST['fundaddr']);
          $sql = "INSERT INTO `fvfs`( `addr`, `location1`, `location2`,`endtime`, `pdesc`, `fundaddr`) VALUES ('".$addr."','".$location1."','".$location2."','".$endtime."','".$pdesc."','".$fundaddr."')";

          $result = $conn->query($sql);
          $sql = "UPDATE `accounts` SET `credits` = `credits`-1 WHERE `accounts`.`address` = '".$_SESSION["addr"]."';";
         $conn->query($sql);
          echo '{"success":true}';
        } else {
          echo '{"success":false}';
        }
} else {
    echo '{"success":false}';
}

?>
