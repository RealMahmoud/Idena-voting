<?php
session_start();
include(dirname(__FILE__)."/../common/protected.php");
header('Content-Type: application/json');

$reachout = $conn->real_escape_string($_POST['reachout']);
$reachout = htmlspecialchars($reachout);
if(!empty($reachout) && !empty($_SESSION["addr"]))
{
    $sql1 = "SELECT `reachout` FROM `accounts` WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";
    $result_acct = $conn->query($sql1);

    if ($result_acct->num_rows == 0) {

    } else {
            $sql = "UPDATE `accounts` SET `reachout` = '".$reachout."' WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";
            $result = $conn->query($sql);
            echo '{"success":true}';
    }
} else {
    echo '{"success":false, "data": "ERROR"}';
}
?>
