<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
header('Content-Type: application/json');
if(empty($_GET['pid'])||empty($_GET['type'])){
  die("Error");
}
$type = $conn->real_escape_string($_GET['type']);
$pid = $conn->real_escape_string($_GET['pid']);
$state = $conn->real_escape_string($_GET['state']);
if($type=='poll'){
$resultjson =(object)array();


$result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `pid` = '".$pid."' AND `type` = '".$type."';");
$row = $result->fetch_row();
$resultjson->AllVotesCount=$row[0];


$result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `state` = '".$state."' AND `pid` = '".$pid."' AND `type` = '".$type."';");
$row = $result->fetch_row();
$resultjson->Count=$row[0];





$result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE (`state` <> 'Human' AND `state` <> 'Verified' AND `state` <> 'Newbie' ) AND `pid` = '".$pid."' AND `type` = '".$type."';");
$row = $result->fetch_row();
$resultjson->NoneValidatedVotesCount=$row[0];


$result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE (`state` = 'Human' or `state` = 'Verified' or `state` = 'Newbie') AND `pid` = '".$pid."' AND `type` = '".$type."';");
$row = $result->fetch_row();
$resultjson->ValidatedVotesCount=$row[0];


echo json_encode($resultjson);
}






?>
