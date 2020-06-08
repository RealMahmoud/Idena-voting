<?php
session_start();

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
        if ($_POST['type'] == 'proposal'){
          $pdesc = $conn->real_escape_string($_POST['desc']);
          $title = $conn->real_escape_string($_POST['title']);
          $category = $conn->real_escape_string($_POST['category']);
          $option1 = $conn->real_escape_string($_POST['option1']);
          $option2 = $conn->real_escape_string($_POST['option2']);
          $amount = $conn->real_escape_string($_POST['amount']);
          $endtime = $conn->real_escape_string($_POST['endtime']);
           $fundaddr = $conn->real_escape_string($_POST['fundaddr']);
          $sql = "INSERT INTO `proposals`( `pdesc`, `addr`, `option1`,`option2`,`endtime`,`amount`,`fundaddr`,`title`,`category`) VALUES ('".$pdesc."','".$_SESSION["addr"]."','".$option1."','".$option2."','".$endtime."','".$amount."','".$fundaddr."','".$title."','".$category."')";

          $result = $conn->query($sql);
          $sql = "UPDATE `accounts` SET `credits` = `credits`-1 WHERE `accounts`.`addr` = '".$_SESSION["addr"]."';";
         $conn->query($sql);
          echo '{"success":true}';
        } else {
          echo '{"success":false}';
        }
} else {
    echo '{"success":false}';
}

?>
