<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
header('Content-Type: application/json');
if(empty($_GET['pid'])||empty($_GET['vote'])){
  die("Error");
}
$pid = $conn->real_escape_string($_GET['pid']);
$vote = $conn->real_escape_string($_GET['vote']);
$type = $conn->real_escape_string($_GET['type']);
$resultjson =(object)array();

$resultjson->result='true';
$result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE  `vote` = '".$vote."'AND `pid` = '".$pid."' AND `type` = '".$type."';");
$row = $result->fetch_row();
$resultjson->all=$row[0];

$result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE  `vote` = '".$vote."'AND `pid` = '".$pid."' AND `type` = '".$type."'AND`state` = 'Human';");
$row = $result->fetch_row();
$resultjson->human=$row[0];

$result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE  `vote` = '".$vote."'AND `pid` = '".$pid."' AND `type` = '".$type."'AND `state` = 'Verified';");
$row = $result->fetch_row();
$resultjson->verified=$row[0];

$result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE  `vote` = '".$vote."'AND `pid` = '".$pid."' AND `type` = '".$type."'AND`state` = 'Newbie';");
$row = $result->fetch_row();
$resultjson->newbie=$row[0];

$result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE  `vote` = '".$vote."'AND `pid` = '".$pid."' AND `type` = '".$type."' AND`state` <> 'Human' AND `state` <> 'Verified' AND `state` <> 'Newbie';");
$row = $result->fetch_row();
$resultjson->notvalidated=$row[0];


if ($type == 'poll'){
  $db = 'polls';

}else{
    $db = 'proposals';
}
  $exist = 0;
$sql = "SELECT * FROM `".$db."` WHERE `id` = '".$pid."' LIMIT 1;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $resultjson->desc=$row['option'.$vote];
    $exist = 1;
  }
}
if($exist == 0){
  die('{"result":"false"}');
}
echo json_encode($resultjson);


?>
