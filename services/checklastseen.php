<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
header('Content-Type: application/json');
$addressg = $conn->real_escape_string($_GET['addr']);
$sql1 = "SELECT `lastseen` FROM `accounts` WHERE `address` = '".$addressg."' LIMIT 1;";
$result_acct = $conn->query($sql1);
if ($result_acct->num_rows > 0) {
    // output data of each row
        while($row = $result_acct->fetch_assoc()) {
        if($row['lastseen']=='undefined'){
            $lastseen = ' - ';
        } else {
            $lastseen = $row['lastseen'];
        }
    }
    echo '{"lastseen":"'.$lastseen.'"}';
}else{
  echo '{"lastseen":" - "}';
}
?>
