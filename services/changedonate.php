<?php
session_start();
include(dirname(__FILE__)."/../common/protected.php");
header('Content-Type: application/json');

$donate = $conn->real_escape_string($_POST['donate']);
$donate = htmlspecialchars($donate);
if(isset($donate) && !empty($_SESSION["addr"]))
{
    if(!strlen($donate) == 42){
      echo '{"success":false, "data": "Accepts only 42 char address"}';
    }
    $sql1 = "SELECT `donate` FROM `accounts` WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";
    $result_acct = $conn->query($sql1);

    if ($result_acct->num_rows == 0) {

    } else {
            $sql = "UPDATE `accounts` SET `donate` = '".$donate."' WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";
            $result = $conn->query($sql);
            echo '{"success":true}';
    }
} else {
    echo '{"success":false, "data": "ERROR"}';
}
?>
