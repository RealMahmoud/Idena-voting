<?php
session_start();
include(dirname(__FILE__)."/../common/_public.php");
header('Content-Type: application/json');
if(empty($_GET['pid'])||empty($_GET['type'])){
  die("Error");
}
$type = $conn->real_escape_string($_GET['type']);
$pid = $conn->real_escape_string($_GET['pid']);

if($type=='poll'){


  $Human =(object)array();
  // 0 To 2
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '0' AND `age` <= '2' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Human->E0To2=$row[0];
  // 3 To 6
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '3' AND `age` <= '6' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Human->E3To6=$row[0];
  // 7 To 11
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '7' AND `age` <= '11' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Human->E7To11=$row[0];

  // 12 To 17
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '12' AND `age` <= '17' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Human->E12To17=$row[0];


  // 18 To 25
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '18' AND `age` <= '25' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Human->E18To25=$row[0];

  // 26 To 32
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '26' AND `age` <= '32' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Human->E26To32=$row[0];

  // 33 To 40
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '32' AND `age` <= '40' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Human->E33To40=$row[0];

  // 41 To 47
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '41' AND `age` <= '47' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Human->E41To47=$row[0];




  $Verified =(object)array();
  // 0 To 2
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '0' AND `age` <= '2' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Verified->E0To2=$row[0];
  // 3 To 6
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '3' AND `age` <= '6' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Verified->E3To6=$row[0];
  // 7 To 11
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '7' AND `age` <= '11' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Verified->E7To11=$row[0];

  // 12 To 17
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '12' AND `age` <= '17' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Verified->E12To17=$row[0];


  // 18 To 25
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '18' AND `age` <= '25' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Verified->E18To25=$row[0];

  // 26 To 32
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '26' AND `age` <= '32' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Verified->E26To32=$row[0];

  // 33 To 40
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '32' AND `age` <= '40' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Verified->E33To40=$row[0];

  // 41 To 47
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '41' AND `age` <= '47' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Verified->E41To47=$row[0];







  $Newbie =(object)array();
  // 0 To 2
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '0' AND `age` <= '2' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Newbie->E0To2=$row[0];
  // 3 To 6
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '3' AND `age` <= '6' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Newbie->E3To6=$row[0];
  // 7 To 11
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '7' AND `age` <= '11' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Newbie->E7To11=$row[0];

  // 12 To 17
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '12' AND `age` <= '17' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Newbie->E12To17=$row[0];


  // 18 To 25
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '18' AND `age` <= '25' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Newbie->E18To25=$row[0];

  // 26 To 32
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '26' AND `age` <= '32' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Newbie->E26To32=$row[0];

  // 33 To 40
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '32' AND `age` <= '40' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Newbie->E33To40=$row[0];

  // 41 To 47
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '41' AND `age` <= '47' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'poll'");
  $row = $result->fetch_row();
  $Newbie->E41To47=$row[0];



$final = array(
    "result" => array(
    "Human" =>  $Human,
    "Verified" =>  $Verified,
    "Newbie" =>  $Newbie,

    )
);

echo json_encode($final);
}
if($type=='proposal'){


  $Human =(object)array();
  // 0 To 2
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '0' AND `age` <= '2' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Human->E0To2=$row[0];
  // 3 To 6
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '3' AND `age` <= '6' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Human->E3To6=$row[0];
  // 7 To 11
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '7' AND `age` <= '11' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Human->E7To11=$row[0];

  // 12 To 17
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '12' AND `age` <= '17' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Human->E12To17=$row[0];


  // 18 To 25
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '18' AND `age` <= '25' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Human->E18To25=$row[0];

  // 26 To 32
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '26' AND `age` <= '32' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Human->E26To32=$row[0];

  // 33 To 40
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '32' AND `age` <= '40' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Human->E33To40=$row[0];

  // 41 To 47
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '41' AND `age` <= '47' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Human->E41To47=$row[0];




  $Verified =(object)array();
  // 0 To 2
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '0' AND `age` <= '2' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Verified->E0To2=$row[0];
  // 3 To 6
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '3' AND `age` <= '6' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Verified->E3To6=$row[0];
  // 7 To 11
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '7' AND `age` <= '11' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Verified->E7To11=$row[0];

  // 12 To 17
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '12' AND `age` <= '17' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Verified->E12To17=$row[0];


  // 18 To 25
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '18' AND `age` <= '25' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Verified->E18To25=$row[0];

  // 26 To 32
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '26' AND `age` <= '32' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Verified->E26To32=$row[0];

  // 33 To 40
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '32' AND `age` <= '40' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Verified->E33To40=$row[0];

  // 41 To 47
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '41' AND `age` <= '47' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Verified->E41To47=$row[0];







  $Newbie =(object)array();
  // 0 To 2
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '0' AND `age` <= '2' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Newbie->E0To2=$row[0];
  // 3 To 6
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '3' AND `age` <= '6' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Newbie->E3To6=$row[0];
  // 7 To 11
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '7' AND `age` <= '11' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Newbie->E7To11=$row[0];

  // 12 To 17
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '12' AND `age` <= '17' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Newbie->E12To17=$row[0];


  // 18 To 25
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '18' AND `age` <= '25' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Newbie->E18To25=$row[0];

  // 26 To 32
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '26' AND `age` <= '32' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Newbie->E26To32=$row[0];

  // 33 To 40
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '32' AND `age` <= '40' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Newbie->E33To40=$row[0];

  // 41 To 47
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '41' AND `age` <= '47' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'proposal'");
  $row = $result->fetch_row();
  $Newbie->E41To47=$row[0];








  $final = array(
      "result" => array(
      "Human" =>  $Human,
      "Verified" =>  $Verified,
      "Newbie" =>  $Newbie,

      )
  );

  echo json_encode($final);
}

















if($type=='fvf'){


  $Human =(object)array();
  // 0 To 2
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '0' AND `age` <= '2' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Human->E0To2=$row[0];
  // 3 To 6
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '3' AND `age` <= '6' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Human->E3To6=$row[0];
  // 7 To 11
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '7' AND `age` <= '11' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Human->E7To11=$row[0];

  // 12 To 17
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '12' AND `age` <= '17' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Human->E12To17=$row[0];


  // 18 To 25
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '18' AND `age` <= '25' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Human->E18To25=$row[0];

  // 26 To 32
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '26' AND `age` <= '32' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Human->E26To32=$row[0];

  // 33 To 40
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '32' AND `age` <= '40' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Human->E33To40=$row[0];

  // 41 To 47
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '41' AND `age` <= '47' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Human->E41To47=$row[0];




  $Verified =(object)array();
  // 0 To 2
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '0' AND `age` <= '2' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Verified->E0To2=$row[0];
  // 3 To 6
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '3' AND `age` <= '6' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Verified->E3To6=$row[0];
  // 7 To 11
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '7' AND `age` <= '11' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Verified->E7To11=$row[0];

  // 12 To 17
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '12' AND `age` <= '17' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Verified->E12To17=$row[0];


  // 18 To 25
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '18' AND `age` <= '25' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Verified->E18To25=$row[0];

  // 26 To 32
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '26' AND `age` <= '32' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Verified->E26To32=$row[0];

  // 33 To 40
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '32' AND `age` <= '40' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Verified->E33To40=$row[0];

  // 41 To 47
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '41' AND `age` <= '47' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Verified->E41To47=$row[0];







  $Newbie =(object)array();
  // 0 To 2
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '0' AND `age` <= '2' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Newbie->E0To2=$row[0];
  // 3 To 6
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '3' AND `age` <= '6' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Newbie->E3To6=$row[0];
  // 7 To 11
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '7' AND `age` <= '11' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Newbie->E7To11=$row[0];

  // 12 To 17
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '12' AND `age` <= '17' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Newbie->E12To17=$row[0];


  // 18 To 25
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '18' AND `age` <= '25' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Newbie->E18To25=$row[0];

  // 26 To 32
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '26' AND `age` <= '32' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Newbie->E26To32=$row[0];

  // 33 To 40
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '32' AND `age` <= '40' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Newbie->E33To40=$row[0];

  // 41 To 47
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '41' AND `age` <= '47' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'fvf'");
  $row = $result->fetch_row();
  $Newbie->E41To47=$row[0];








  $final = array(
      "result" => array(
      "Human" =>  $Human,
      "Verified" =>  $Verified,
      "Newbie" =>  $Newbie,

      )
  );

  echo json_encode($final);
}







?>
