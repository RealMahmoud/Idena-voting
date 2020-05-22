<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
include(dirname(__FILE__)."/../common/protected.php");
header('Content-Type: application/json');
<<<<<<< HEAD
if($credits =< 0){
  die('{"success":false}');
}
$description = $conn->real_escape_string($_POST['desc']);
$endtime = $conn->real_escape_string($_POST['endtime']);
$option1 = $conn->real_escape_string($_POST['option1']);
$option2 = $conn->real_escape_string($_POST['option2']);
$option3 = $conn->real_escape_string($_POST['option3']);
$option4 = $conn->real_escape_string($_POST['option4']);
$option5 = $conn->real_escape_string($_POST['option5']);
$option6 = $conn->real_escape_string($_POST['option6']);
$endtime = $conn->real_escape_string($_POST['endtime']);
if(!empty($description) && !empty($addr))
{
        if ($_POST['type'] == 'poll'){
          $sql = "INSERT INTO `polls`( `pdesc`, `addr`,`option1`,`option2`,`option3`,`option4`,`option5`,`option6`,`endtime`) VALUES ('".$description."','".$addr."','".$option1."','".$option2."','".$option3."','".$option4."','".$option5."','".$option6."','".$endtime."')";
          $result = $conn->query($sql);
          $sql = "UPDATE `accounts` SET `credits` = `credits`-1 WHERE `accounts`.`addr` = '$addr';";
         $conn->query($sql);
=======

$description = $conn->real_escape_string($_POST['desc']);

if(!empty($description) && !empty($addr))
{
        if ($_POST['type'] == 'poll'){
          $sql = "INSERT INTO `polls`( `pdesc`, `addr`) VALUES ('".$description."','".$addr."')";
          $result = $conn->query($sql);
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
          echo '{"success":true}';
        } else {
          echo '{"success":false}';
        }
} else {
    echo '{"success":false}';
}
<<<<<<< HEAD

=======
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
?>
