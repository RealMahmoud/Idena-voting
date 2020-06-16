<?php
session_start();
include(dirname(__FILE__)."/../common/_protected.php");
header('Content-Type: application/json');

$pic = $conn->real_escape_string($_POST['pic']);
$pic = htmlspecialchars($pic);
if(!empty($pic) && !empty($_SESSION["addr"]))
{

  if(!strlen($pic) > 50){
    die('{"success":false, "data": "Sorry Max Char is 50"}');
  }
    $sql1 = "SELECT `pic` FROM `accounts` WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";
    $result_acct = $conn->query($sql1);

    if ($result_acct->num_rows == 0) {

    } else {
            $sql = "UPDATE `accounts` SET `pic` = '".$pic."' WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";
            $result = $conn->query($sql);
            $_SESSION["pic"] = $pic;
            echo '{"success":true}';
    }
} else {
    echo '{"success":false, "data": "ERROR"}';
}
?>
