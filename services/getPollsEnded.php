<?php
session_start();
include(dirname(__FILE__)."/../common/_public.php");
header('Content-Type: application/json');
$polls = array();
$entries = array();


//username
if( !empty($_GET['user']) && empty($_GET['cat'])){
  $result = $conn->query("SELECT `address` FROM accounts WHERE `username` = '".$conn->real_escape_string($_GET['user'])."' LIMIT 1;");
  $row = $result->fetch_row();
  $addressk = $row[0];
  $sql1 = "SELECT `id` ,`pdesc`, `title`,`category`,`endtime`,`vip`, (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE (`state` = 'Verified' OR `state` = 'Human' OR `state` = 'Newbie')AND `type` = 'poll' AND `pid`= `polls`.`id` )AS 'count' FROM polls WHERE `endtime` < NOW() AND `addr`= '".$addressk."'   ORDER BY `vip` DESC, (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE  `type` = 'poll' AND `pid`= `polls`.`id`) DESC LIMIT 50";
}

//username + cat
if( !empty($_GET['user']) && !empty($_GET['cat'])){
  $result = $conn->query("SELECT `address` FROM accounts WHERE `username` = '".$conn->real_escape_string($_GET['user'])."' LIMIT 1;");
  $row = $result->fetch_row();
  $addressk = $row[0];
  $cat = $conn->real_escape_string($_GET['cat']);
  $sql1 = "SELECT `id` ,`pdesc`, `title`,`category`,`endtime`,`vip`, (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE (`state` = 'Verified' OR `state` = 'Human' OR `state` = 'Newbie')AND `type` = 'poll' AND `pid`= `polls`.`id` )AS 'count' FROM polls WHERE `endtime` < NOW() AND `polls`.`category` = '".$cat."' AND `addr`= '".$addressk."'  ORDER BY `vip` DESC, (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE  `type` = 'poll' AND `pid`= `polls`.`id`) DESC LIMIT 50";
}









//all
if( empty($_GET['user']) && empty($_GET['cat'])){

  $sql1 = "SELECT `id` ,`pdesc`, `title`,`category`,`endtime`,`vip`, (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE (`state` = 'Verified' OR `state` = 'Human' OR `state` = 'Newbie')AND `type` = 'poll' AND `pid`= `polls`.`id` )AS 'count' FROM polls WHERE `endtime` < NOW()   ORDER BY `vip` DESC, (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE  `type` = 'poll' AND `pid`= `polls`.`id`) DESC LIMIT 50";
}


//all  + cat
if( empty($_GET['user']) && !empty($_GET['cat'])){
  $cat = $conn->real_escape_string($_GET['cat']);
  $sql1 = "SELECT `id` ,`pdesc`, `title`,`category`,`endtime`,`vip`, (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE (`state` = 'Verified' OR `state` = 'Human' OR `state` = 'Newbie')AND `type` = 'poll' AND `pid`= `polls`.`id` )AS 'count' FROM polls WHERE `endtime` < NOW() AND `polls`.`category` = '".$cat."'    ORDER BY `vip` DESC, (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE  `type` = 'poll' AND `pid`= `polls`.`id`) DESC LIMIT 50";
}



    $result_acct = $conn->query($sql1);
    if ($result_acct->num_rows > 0) {
        // output data of each row
                while($row = $result_acct->fetch_assoc()) {
                    $polls[] = array('id' => $row['id'],'endtime' => date('Y-m-d H:i', strtotime($row['endtime'])),'vip' => $row['vip'],'count' => $row['count'],'title' => mb_strimwidth($row['title'], 0, 30, '...'),'category' =>  $row['category']);
                }

    }
    $entries = $result = array('entries' => $polls);
    echo json_encode($entries);

















?>
