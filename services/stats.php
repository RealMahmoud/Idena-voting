<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
// header('Content-Type: application/json');
if(empty($_GET['pid'])||empty($_GET['type'])){
  die("Error");
}
$type = $conn->real_escape_string($_GET['type']);
$pid = $conn->real_escape_string($_GET['pid']);

// Count votes
$result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `pid` = '".$pid."' AND `type` = '".$type."';");
$row = $result->fetch_row();
echo '<br>AllVotesCount:'.$row[0];

$result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `state` = 'Human' AND `pid` = '".$pid."' AND `type` = '".$type."';");
$row = $result->fetch_row();
echo '<br>HumansVotesCount:'.$row[0];

$result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = '".$type."';");
$row = $result->fetch_row();
echo '<br>VerifiedVotesCount:'.$row[0];

$result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = '".$type."';");
$row = $result->fetch_row();
echo '<br>NewbieVotesCount:'.$row[0];

$result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `state` <> 'Human' AND `state` <> 'Verified' AND `state` <> 'Newbie' AND `pid` = '".$pid."' AND `type` = '".$type."';");
$row = $result->fetch_row();
echo '<br>NoneValidatedVotesCount:'.$row[0];


echo "<br>";

//  Count accounts
$result = $conn->query("SELECT COUNT(*) FROM `accounts`;");
$row = $result->fetch_row();
echo '<br>AllValidatedCount:'.$row[0];
$result = $conn->query("SELECT COUNT(*) FROM `accounts` WHERE `state` = 'Human';");
$row = $result->fetch_row();
echo '<br>HumansVotesCount:'.$row[0];
$result = $conn->query("SELECT COUNT(*) FROM `accounts` WHERE `state` = 'Verified';");
$row = $result->fetch_row();
echo '<br>VerifiedCount:'.$row[0];
$result = $conn->query("SELECT COUNT(*) FROM `accounts` WHERE `state` = 'Newbie';");
$row = $result->fetch_row();
echo '<br>NewbieCount:'.$row[0];
$result = $conn->query("SELECT COUNT(*) FROM `accounts` WHERE `state` <> 'Human' AND `state` <> 'Verified' AND `state` <> 'Newbie';");
$row = $result->fetch_row();
echo '<br>NoneValidatedCount:'.$row[0];
/*

$result = array("Toyota"=>"Highlander");

$result2 = array("Toota"=>"Highlander");
$result = $result + $result2;





$humans[] = $count

    echo json_encode($result);

*/







?>
