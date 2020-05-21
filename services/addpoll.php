<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
include(dirname(__FILE__)."/../common/protected.php");
header('Content-Type: application/json');

$description = $conn->real_escape_string($_POST['desc']);

if(!empty($description) && !empty($addr))
{
        if ($_POST['type'] == 'poll'){
          $sql = "INSERT INTO `polls`( `pdesc`, `addr`) VALUES ('".$description."','".$addr."')";
          $result = $conn->query($sql);
          echo '{"success":true}';
        } else {
          echo '{"success":false}';
        }
} else {
    echo '{"success":false}';
}
?>
