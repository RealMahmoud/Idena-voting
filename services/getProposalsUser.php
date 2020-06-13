<?php
session_start();
include(dirname(__FILE__)."/../common/_public.php");
header('Content-Type: application/json');
$username = $conn->real_escape_string($_GET['user']);
$proposals = array();
$entries = array();
$result = $conn->query("SELECT `address` FROM accounts WHERE `username` = '".$conn->real_escape_string($_GET['user'])."' LIMIT 1;");
$row = $result->fetch_row();
$addressk = $row[0];
$sql1 = "SELECT `id` ,`pdesc`, `title`,`category`,`endtime`, (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE (`state` = 'Verified' OR `state` = 'Human' OR `state` = 'Newbie')AND `type` = 'proposal' AND `pid`= `proposals`.`id` )AS 'count' FROM proposals  WHERE `addr` = '".$addressk."' ORDER BY (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `state` = 'Verified' AND `type` = 'proposal' AND `pid`= `proposals`.`id`) DESC LIMIT 100";
    $result_acct = $conn->query($sql1);
    if ($result_acct->num_rows > 0) {
        // output data of each row
                while($row = $result_acct->fetch_assoc()) {
                    $proposals[] = array('description' => mb_strimwidth($row['pdesc'], 0, 25, '...'),'id' => $row['id'],'count' => $row['count'],'title' => $row['title'],'category' =>  $row['category'] , `endtime` => $row['endtime']);
                }

    }
    $entries = $result = array('entries' => $proposals);
    echo json_encode($entries);
?>
