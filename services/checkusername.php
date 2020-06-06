<?php
session_start();
include(dirname(__FILE__)."/../common/protected.php");
header('Content-Type: application/json');
$addressg = $conn->real_escape_string($_GET['addr']);
$sql1 = "SELECT `username` FROM `accounts` WHERE `address` = '".$addressg."' LIMIT 1;";
$result_acct = $conn->query($sql1);
if ($result_acct->num_rows > 0) {
    // output data of each row
        while($row = $result_acct->fetch_assoc()) {
        if($row['username']=='undefined'){
            $nickname = ' - ';
        } else {
            $nickname = $row['username'];
        }
    }
    echo '{"nickname":"'.$nickname.'"}';
}else{
  echo '{"nickname":" - "}';
}
?>
