<?php
session_start();

include(dirname(__FILE__)."/../common/_protected.php");
header('Content-Type: application/json');
if(!isset($_POST['vip'])) {
  die('{"success":false,"data":"need to choose vip ot not"}');
}
$sql = "SELECT * FROM `accounts` WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
$vip = $conn->real_escape_string($_POST['vip']);
if($vip == 1){
  $cost = 5;
}else{
  $cost = 1;
}

    if($row['credits'] < $cost){
      die('{"success":false,"data":"no enough credits"}');
    }


  }}


  if(empty($conn->real_escape_string($_POST['desc']))) {
    die('{"success":false,"data":"No desc chosen"}');
  }
  if(empty($conn->real_escape_string($_POST['title']))) {
    die('{"success":false,"data":"No title chosen"}');
  }
  if(empty($conn->real_escape_string($_POST['category']))) {
    die('{"success":false,"data":"No category chosen"}');
  }
  if(empty($conn->real_escape_string($_POST['endtime']))) {
    die('{"success":false,"data":"No EndTime"}');
  }

if(!empty($_SESSION["addr"]))
{
        if ($_POST['type'] == 'poll'){
          $pdesc = $conn->real_escape_string($_POST['desc']);
          $title = $conn->real_escape_string($_POST['title']);
          $category = $conn->real_escape_string($_POST['category']);
          $option1 = $conn->real_escape_string($_POST['option1']);
          $option2 = $conn->real_escape_string($_POST['option2']);
          $option3 = $conn->real_escape_string($_POST['option3']);
          $option4 = $conn->real_escape_string($_POST['option4']);
          $option5 = $conn->real_escape_string($_POST['option5']);
          $option6 = $conn->real_escape_string($_POST['option6']);
          $endtime = $conn->real_escape_string($_POST['endtime']);



          $pdesc = htmlspecialchars($pdesc);
          $title = htmlspecialchars($title);
          $category = htmlspecialchars($category);
          $option1 = htmlspecialchars($option1);
          $option2 = htmlspecialchars($option2);
          $option3 = htmlspecialchars($option3);
          $option4 = htmlspecialchars($option4);
          $option5 = htmlspecialchars($option5);
          $option6 = htmlspecialchars($option6);
          $endtime = htmlspecialchars($endtime);








          $sql = "SELECT * FROM `polls` WHERE `pdesc` = '".$pdesc."' OR `title` = '".$title."' LIMIT 1;";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
          die('{"success":false,"data":"Duplicate Data"}');
          }
          $sql = "INSERT INTO `polls`( `pdesc`, `addr`, `option1`,`option2`,`option3`,`option4`,`option5`,`option6`,`endtime`,`title`,`category`,`vip`) VALUES ('".$pdesc."','".$_SESSION["addr"]."','".$option1."','".$option2."','".$option3."','".$option4."','".$option5."','".$option6."','".$endtime."','".$title."','".$category."','".$vip."')";

          $result = $conn->query($sql);

          $sql = "UPDATE `accounts` SET `credits` = `credits`- ".$cost." WHERE `accounts`.`address` = '".$_SESSION["addr"]."';";
         $conn->query($sql);
          echo '{"success":true}';
        } else {
          echo '{"success":false,"data":"This is not poll"}';
        }
} else {
    echo '{"success":false,"data":"You need to be signed in"}';
}

?>
