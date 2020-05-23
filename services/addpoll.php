<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
include(dirname(__FILE__)."/../common/protected.php");
header('Content-Type: application/json');
if($credits < 1){
  die('{"success":false}');
}

if(!empty($addr))
{
        if ($_POST['type'] == 'poll'){
          $description = $conn->real_escape_string($_POST['desc']);
          $option1 = $conn->real_escape_string($_POST['option1']);
          $option2 = $conn->real_escape_string($_POST['option2']);
          $option3 = $conn->real_escape_string($_POST['option3']);
          $option4 = $conn->real_escape_string($_POST['option4']);
          $option5 = $conn->real_escape_string($_POST['option5']);
          $option6 = $conn->real_escape_string($_POST['option6']);
          $endtime = $conn->real_escape_string($_POST['endtime']);

          $sql = "INSERT INTO `polls`( `pdesc`, `addr`, `option1`,`option2`,`option3`,`option4`,`option5`,`option6`,`endtime`) VALUES ('".$description."','".$addr."','".$option1."','".$option2."','".$option3."','".$option4."','".$option5."','".$option6."','".$endtime."')";

          $result = $conn->query($sql);
          $sql = "UPDATE `accounts` SET `credits` = `credits`-1 WHERE `accounts`.`address` = '$addr';";
         $conn->query($sql);
          echo '{"success":true}';
        } else {
          echo '{"success":false}';
        }
} else {
    echo '{"success":false}';
}

?>
