<?php
session_start();
include(dirname(__FILE__)."/../common/_protected.php");
header('Content-Type: application/json');

$bio = $conn->real_escape_string($_POST['bio']);
$bio = htmlspecialchars($bio);
if(!empty($bio) && !empty($_SESSION["addr"]))
{

  if(!strlen($bio) > 250){
    die('{"success":false, "data": "Sorry Max Char is 250"}');
  }
    $sql1 = "SELECT `bio` FROM `accounts` WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";
    $result_acct = $conn->query($sql1);

    if ($result_acct->num_rows == 0) {

    } else {
            $sql = "UPDATE `accounts` SET `bio` = '".$bio."' WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";
            $result = $conn->query($sql);
            echo '{"success":true}';
    }
} else {
    echo '{"success":false, "data": "Empty Bio ?"}';
}
?>
