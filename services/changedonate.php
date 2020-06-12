<?php
session_start();
include(dirname(__FILE__)."/../common/protected.php");
header('Content-Type: application/json');

$username = $conn->real_escape_string($_POST['username']);

if(!empty($username) && !empty($_SESSION["addr"]))
{
    $sql1 = "SELECT `username` FROM `accounts` WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";
    $result_acct = $conn->query($sql1);

    if ($result_acct->num_rows == 0) {

    } else {
            $sql = "UPDATE `accounts` SET `username` = '".$username."' WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";
            $result = $conn->query($sql);
            echo '{"success":true}';
    }
} else {
    echo '{"success":false}';
}
?>
