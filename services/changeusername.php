<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
include(dirname(__FILE__)."/../common/protected.php");
header('Content-Type: application/json');

$nickname = $conn->real_escape_string($_POST['username']);

if(!empty($nickname) && !empty($addr))
{
    $sql1 = "SELECT `username` FROM `accounts` WHERE `address` = '".$addr."' LIMIT 1;";
    $result_acct = $conn->query($sql1);
    
    if ($result_acct->num_rows == 0) {
            $t=time();
            $timestamp = date("yy-m-d h:m:s",$t);
            $sql = "INSERT INTO `accounts` (`address`, `lastlogin`, `votescount`, `status`, `username`) VALUES
('".$addr."', '".$timestamp."', 0, '".$state."', '".$nickname."');";
            $result = $conn->query($sql);
            echo '{"success":true}';
    } else {
            $sql = "UPDATE `accounts` SET `username` = '".$nickname."' WHERE `address` = '".$addr."' LIMIT 1;";
            $result = $conn->query($sql);
            echo '{"success":true}';
    }
} else {
    echo '{"success":false}';
}
?>
