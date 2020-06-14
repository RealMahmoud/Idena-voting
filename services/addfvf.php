<?php
session_start();

include(dirname(__FILE__)."/../common/protected.php");
header('Content-Type: application/json');
if(empty($conn->real_escape_string($_POST['vip']))) {
  die('{"success":false}');
}
$sql = "SELECT * FROM `accounts` WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
$vip = $conn->real_escape_string($_POST['vip']);
if($vip == 1){
  $cost = 5;
}else{
  $cost = 1;
}

    if($row['credits'] < $cost){
      die('{"success":false}');
    }


  }}


  if(empty($conn->real_escape_string($_POST['desc']))) {
    die('{"success":false}');
  }
  if(empty($conn->real_escape_string($_POST['title']))) {
    die('{"success":false}');
  }
  if(empty($conn->real_escape_string($_POST['location1']))) {
    die('{"success":false}');
  }
  if(empty($conn->real_escape_string($_POST['location2']))) {
    die('{"success":false}');
  }
  if(empty($conn->real_escape_string($_POST['category']))) {
    die('{"success":false}');
  }
  if(empty($conn->real_escape_string($_POST['endtime']))) {
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
          $title = $conn->real_escape_string($_POST['title']);
          $category = $conn->real_escape_string($_POST['category']);
          $fundaddr = $conn->real_escape_string($_POST['fundaddr']);
          $vip = $conn->real_escape_string($_POST['vip']);

          $sql = "SELECT * FROM `fvfs` WHERE `pdesc` = '".$pdesc."' OR `title` = '".$title."' LIMIT 1;";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
          die('{"success":false}');
          }
          $sql = "INSERT INTO `fvfs`( `addr`, `location1`, `location2`,`endtime`, `pdesc`, `fundaddr` ,  `title`,`category`,`vip`) VALUES ('".$addr."','".$location1."','".$location2."','".$endtime."','".$pdesc."','".$fundaddr."' ,'".$title."','".$category."','".$vip."')";

          $result = $conn->query($sql);
          $sql = "UPDATE `accounts` SET `credits` = `credits`-".$cost." WHERE `accounts`.`address` = '".$_SESSION["addr"]."';";
         $conn->query($sql);
          echo '{"success":true}';
        } else {
          echo '{"success":false}';
        }
} else {
    echo '{"success":false}';
}

?>
