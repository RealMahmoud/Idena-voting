<?php
session_start();
include(dirname(__FILE__)."/../common/_public.php");
header('Content-Type: application/json');
$username = $conn->real_escape_string($_GET['user']);
$fvfs = array();
$entries = array();

$result = $conn->query("SELECT `address` FROM accounts WHERE `username` = '".$conn->real_escape_string($_GET['user'])."' LIMIT 1;");
$row = $result->fetch_row();
$addressk = $row[0];

$sql1 = "SELECT `id` ,`pdesc`, `title`,`category`,`endtime`, (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE (`state` = 'Verified' OR `state` = 'Human' OR `state` = 'Newbie')AND `type` = 'fvf' AND `pid`= `fvfs`.`id` )AS 'count' FROM fvfs  WHERE `addr` = '".$addressk."' ORDER BY (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `state` = 'Verified' AND `type` = 'fvf' AND `pid`= `fvfs`.`id`) DESC LIMIT 100";
    $result_acct = $conn->query($sql1);
    if ($result_acct->num_rows > 0) {
        // output data of each row
                while($row = $result_acct->fetch_assoc()) {
                    $fvfs[] = array('id' => $row['id'],'endtime' => date('Y-m-d H:i', strtotime(date('Y-m-d H:i', strtotime($row['endtime'])))),'count' => $row['count'],'title' => mb_strimwidth($row['title'], 0, 30, '...'),'fulltitle' => $row['title'],'category' =>  $row['category']);
                }

    }
    $entries = $result = array('entries' => $fvfs);
    echo json_encode($entries);
?>
