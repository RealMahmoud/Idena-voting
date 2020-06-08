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
        if ($_POST['type'] == 'poll'){
          $pdesc = $conn->real_escape_string($_POST['desc']);
          $title = $conn->real_escape_string($_POST['title']);
          $category = $conn->real_escape_string($_POST['category']);
          $option1 = $conn->real_escape_string($_POST['option1']);
          $option2 = $conn->real_escape_string($_POST['option2']);
          $option3 = $conn->real_escape_string($_POST['option3']);
          $option4 = $conn->real_escape_string($_POST['option4']);
          $option5 = $conn->real_escape_string($_POST['option5']);
          $option6 = $conn->real_escape_string($_POST['option6']);
          $endtime = $conn->real_escape_string($_POST['endtime']);

          $sql = "INSERT INTO `polls`( `pdesc`, `addr`, `option1`,`option2`,`option3`,`option4`,`option5`,`option6`,`endtime`,`title`,`category`) VALUES ('".$pdesc."','".$_SESSION["addr"]."','".$option1."','".$option2."','".$option3."','".$option4."','".$option5."','".$option6."','".$endtime."','".$title."','".$category."')";

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
