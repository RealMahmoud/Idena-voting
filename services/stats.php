<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
header('Content-Type: application/json');
if(empty($_GET['pid'])||empty($_GET['type'])){
  die("Error");
}
$type = $conn->real_escape_string($_GET['type']);
$pid = $conn->real_escape_string($_GET['pid']);
$age = $conn->real_escape_string($_GET['age']);


if($type=='poll'){
  $Option1 =(object)array();
  $vote='1';
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option1->Human=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option1->Verified=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option1->Newbie=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Suspended' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option1->Suspended=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` <> 'Human' AND `state` <> 'Verified' AND `state` <> 'Newbie' )AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option1->NotValidated=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` = 'Human' OR `state` = 'Verified' ) AND `pid` = '".$pid."' AND `type` ='poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option1->HumanAndVerified=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `pid` = '".$pid."' AND `type` ='poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option1->All=$row[0];
    $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` = 'Human' OR `state` = 'Verified' OR `state` = 'Newbie' ) AND `pid` = '".$pid."' AND `type` ='poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option1->Validated=$row[0];


  $Option2 =(object)array();
  $vote='2';
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option2->Human=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option2->Verified=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option2->Newbie=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Suspended' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option2->Suspended=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` <> 'Human' AND `state` <> 'Verified' AND `state` <> 'Newbie' )AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option2->NotValidated=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` = 'Human' OR `state` = 'Verified'  ) AND `pid` = '".$pid."' AND `type` ='poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option2->HumanAndVerified=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `pid` = '".$pid."' AND `type` ='poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option2->All=$row[0];
    $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` = 'Human' OR `state` = 'Verified' OR `state` = 'Newbie' ) AND `pid` = '".$pid."' AND `type` ='poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option2->Validated=$row[0];


  $Option3 =(object)array();
  $vote='3';
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option3->Human=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option3->Verified=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option3->Newbie=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Suspended' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option3->Suspended=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` <> 'Human' AND `state` <> 'Verified' AND `state` <> 'Newbie' )AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option3->NotValidated=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` = 'Human' OR `state` = 'Verified' ) AND `pid` = '".$pid."' AND `type` ='poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option3->HumanAndVerified=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `pid` = '".$pid."' AND `type` ='poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option3->All=$row[0];
    $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` = 'Human' OR `state` = 'Verified' OR `state` = 'Newbie' ) AND `pid` = '".$pid."' AND `type` ='poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option3->Validated=$row[0];


  $Option4 =(object)array();
  $vote='4';
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option4->Human=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option4->Verified=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option4->Newbie=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Suspended' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option4->Suspended=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` <> 'Human' AND `state` <> 'Verified' AND `state` <> 'Newbie' )AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option4->NotValidated=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` = 'Human' OR `state` = 'Verified'  ) AND `pid` = '".$pid."' AND `type` ='poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option4->HumanAndVerified=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `pid` = '".$pid."' AND `type` ='poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option4->All=$row[0];
    $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` = 'Human' OR `state` = 'Verified' OR `state` = 'Newbie' ) AND `pid` = '".$pid."' AND `type` ='poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option4->Validated=$row[0];


  $Option5 =(object)array();
  $vote='5';
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option5->Human=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option5->Verified=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option5->Newbie=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Suspended' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option5->Suspended=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` <> 'Human' AND `state` <> 'Verified' AND `state` <> 'Newbie' )AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option5->NotValidated=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` = 'Human' OR `state` = 'Verified' ) AND `pid` = '".$pid."' AND `type` ='poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option5->HumanAndVerified=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `pid` = '".$pid."' AND `type` ='poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option5->All=$row[0];
    $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` = 'Human' OR `state` = 'Verified' OR `state` = 'Newbie' ) AND `pid` = '".$pid."' AND `type` ='poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option5->Validated=$row[0];



  $Option6 =(object)array();
  $vote='6';
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option6->Human=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option6->Verified=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option6->Newbie=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Suspended' AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option6->Suspended=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` <> 'Human' AND `state` <> 'Verified' AND `state` <> 'Newbie' ) AND `pid` = '".$pid."' AND `type` = 'poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option6->NotValidated=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` = 'Human' OR `state` = 'Verified' ) AND `pid` = '".$pid."' AND `type` ='poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option6->HumanAndVerified=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `pid` = '".$pid."' AND `type` ='poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option6->All=$row[0];
    $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` = 'Human' OR `state` = 'Verified' OR `state` = 'Newbie' ) AND `pid` = '".$pid."' AND `type` ='poll' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option6->Validated=$row[0];

  $sql = "SELECT * FROM `polls` WHERE  `id` = '".$pid."' LIMIT 1;";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $Option1->Desc=$row['option1'];
      $Option2->Desc=$row['option2'];
      $Option3->Desc=$row['option3'];
      $Option4->Desc=$row['option4'];
      $Option5->Desc=$row['option5'];
      $Option6->Desc=$row['option6'];

    }
  }



$final = array(
    "result" => array(
    "option1" =>  $Option1,
    "option2" =>  $Option2,
    "option3" =>  $Option3,
    "option4" =>  $Option4,
    "option5" =>  $Option5,
    "option6" =>  $Option6,

    )
);

echo json_encode($final);
}
if($type=='proposal'){


  $Option1 =(object)array();
  $vote='1';
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'proposal' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option1->Human=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'proposal' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option1->Verified=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'proposal' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option1->Newbie=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Suspended' AND `pid` = '".$pid."' AND `type` = 'proposal' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option1->Suspended=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` <> 'Human' AND `state` <> 'Verified' AND `state` <> 'Newbie' )AND `pid` = '".$pid."' AND `type` = 'proposal' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option1->NotValidated=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` = 'Human' OR `state` = 'Verified' ) AND `pid` = '".$pid."' AND `type` ='proposal' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option1->HumanAndVerified=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `pid` = '".$pid."' AND `type` ='proposal' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option1->All=$row[0];
    $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` = 'Human' OR `state` = 'Verified' OR `state` = 'Newbie' ) AND `pid` = '".$pid."' AND `type` ='proposal' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option1->Validated=$row[0];


  $Option2 =(object)array();
  $vote='2';
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'proposal' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option2->Human=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'proposal' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option2->Verified=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'proposal' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option2->Newbie=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Suspended' AND `pid` = '".$pid."' AND `type` = 'proposal' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option2->Suspended=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` <> 'Human' AND `state` <> 'Verified' AND `state` <> 'Newbie' )AND `pid` = '".$pid."' AND `type` = 'proposal' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option2->NotValidated=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` = 'Human' OR `state` = 'Verified'  ) AND `pid` = '".$pid."' AND `type` ='proposal' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option2->HumanAndVerified=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `pid` = '".$pid."' AND `type` ='proposal' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option2->All=$row[0];
    $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` = 'Human' OR `state` = 'Verified' OR `state` = 'Newbie' ) AND `pid` = '".$pid."' AND `type` ='proposal' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Option2->Validated=$row[0];








  $sql = "SELECT * FROM `proposals` WHERE  `id` = '".$pid."' LIMIT 1;";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
  	while($row = $result->fetch_assoc()) {
  		$Option1->Desc=$row['option1'];
  		$Option2->Desc=$row['option2'];


  	}
  }



  $final = array(
  	"result" => array(
  	"option1" =>  $Option1,
  	"option2" =>  $Option2,

  	)
  );

  echo json_encode($final);
}
















if($type=='fvf'){


  $Left =(object)array();
  $vote='1';
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'fvf' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Left->Human=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'fvf' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Left->Verified=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'fvf' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Left->Newbie=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Suspended' AND `pid` = '".$pid."' AND `type` = 'fvf' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Left->Suspended=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` <> 'Human' AND `state` <> 'Verified' AND `state` <> 'Newbie' )AND `pid` = '".$pid."' AND `type` = 'fvf' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Left->NotValidated=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` = 'Human' OR `state` = 'Verified' ) AND `pid` = '".$pid."' AND `type` ='fvf' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Left->HumanAndVerified=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `pid` = '".$pid."' AND `type` ='fvf' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Left->All=$row[0];


  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` = 'Human' OR `state` = 'Verified' OR `state` = 'Newbie' ) AND `pid` = '".$pid."' AND `type` ='fvf' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Left->Validated=$row[0];

  $Right =(object)array();
  $vote='2';
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Human' AND `pid` = '".$pid."' AND `type` = 'fvf' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Right->Human=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Verified' AND `pid` = '".$pid."' AND `type` = 'fvf' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Right->Verified=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Newbie' AND `pid` = '".$pid."' AND `type` = 'fvf' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Right->Newbie=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `state` = 'Suspended' AND `pid` = '".$pid."' AND `type` = 'fvf' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Right->Suspended=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` <> 'Human' AND `state` <> 'Verified' AND `state` <> 'Newbie' )AND `pid` = '".$pid."' AND `type` = 'fvf' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Right->NotValidated=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` = 'Human' OR `state` = 'Verified'  ) AND `pid` = '".$pid."' AND `type` ='fvf' AND `vote` = '".$vote."';");
  $row = $result->fetch_row();
  $Right->HumanAndVerified=$row[0];
  $result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND `pid` = '".$pid."' AND `type` ='fvf' AND `vote` = '".$vote."';");
    $row = $result->fetch_row();
    $Right->All=$row[0];
$result = $conn->query("SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `age` >= '".$age."' AND (`state` = 'Human' OR `state` = 'Verified' OR `state` = 'Newbie' ) AND `pid` = '".$pid."' AND `type` ='fvf' AND `vote` = '".$vote."';");
    $row = $result->fetch_row();
    $Right->Validated=$row[0];



  $Left->Desc='Left';
  $Right->Desc='Right';


  $final = array(
  	"result" => array(
  	"Left" =>  $Left,
  	"Right" =>  $Right,

  	)
  );

  echo json_encode($final);
}






?>
