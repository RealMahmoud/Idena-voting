<?php
session_start();
include(dirname(__FILE__)."/../common/protected.php");
header('Content-Type: application/json');

$hidden = $conn->real_escape_string($_POST['hidden']);

if(!empty($hidden) && !empty($_SESSION["addr"]))
{
    $sql1 = "SELECT `hidden` FROM `accounts` WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";
    $result_acct = $conn->query($sql1);

    if ($result_acct->num_rows == 0) {

    } else {

           if($hidden == 'true'){
             $sql = "UPDATE `accounts` SET `hidden` = '1' WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";

           }else{
             $sql = "UPDATE `accounts` SET `hidden` = '0' WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";

           }



            $result = $conn->query($sql);
            echo '{"success":true}';
    }
} else {
    echo '{"success":false}';
}
?>
