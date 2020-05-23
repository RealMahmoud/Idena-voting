<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
header('Content-Type: application/json');
if(empty($_GET['pid'])||empty($_GET['type'])){
  die("Error");
}
$type = $conn->real_escape_string($_GET['type']);
$pid = $conn->real_escape_string($_GET['pid']);
$resultjson =(object)array();
// Count votes
$result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `pid` = '".$pid."' AND `type` = '".$type."';");
$row = $result->fetch_row();
$resultjson->AllVotesCount=$row[0];
$result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `state` = 'Human' AND `pid` = '".$pid."' AND `type` = '".$type."';");
$row = $result->fetch_row();
$resultjson->HumansVotesCount=$row[0];
$result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = '".$type."';");
$row = $result->fetch_row();
$resultjson->VerifiedVotesCount=$row[0];
$result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = '".$type."';");
$row = $result->fetch_row();
$resultjson->NewbieVotesCount=$row[0];
$result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `state` <> 'Human' AND `state` <> 'Verified' AND `state` <> 'Newbie' AND `pid` = '".$pid."' AND `type` = '".$type."';");
$row = $result->fetch_row();
$resultjson->NoneValidatedVotesCount=$row[0];




//  Count accounts
$result = $conn->query("SELECT COUNT(*) FROM `accounts`;");
$row = $result->fetch_row();
$resultjson->AllValidatedCount=$row[0];
$result = $conn->query("SELECT COUNT(*) FROM `accounts` WHERE `state` = 'Human';");
$row = $result->fetch_row();
$resultjson->HumansCount=$row[0];
$result = $conn->query("SELECT COUNT(*) FROM `accounts` WHERE `state` = 'Verified';");
$row = $result->fetch_row();
$resultjson->VerifiedCount=$row[0];
$result = $conn->query("SELECT COUNT(*) FROM `accounts` WHERE `state` = 'Newbie';");
$row = $result->fetch_row();
$resultjson->NewbieCount=$row[0];
$result = $conn->query("SELECT COUNT(*) FROM `accounts` WHERE `state` <> 'Human' AND `state` <> 'Verified' AND `state` <> 'Newbie';");
$row = $result->fetch_row();
$resultjson->NoneValidatedCount=$row[0];
echo json_encode($resultjson);









?>
