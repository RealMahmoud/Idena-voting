<?php
session_start();

include(dirname(__FILE__)."/../common/protected.php");
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
        if ($_POST['type'] == 'proposal'){
          $pdesc = $conn->real_escape_string($_POST['desc']);
          $title = $conn->real_escape_string($_POST['title']);
          $category = $conn->real_escape_string($_POST['category']);
          $option1 = $conn->real_escape_string($_POST['option1']);
          $option2 = $conn->real_escape_string($_POST['option2']);
          $amount = $conn->real_escape_string($_POST['amount']);
          $endtime = $conn->real_escape_string($_POST['endtime']);
           $fundaddr = $conn->real_escape_string($_POST['fundaddr']);




           $pdesc = htmlspecialchars($pdesc);
           $title = htmlspecialchars($title);
           $category = htmlspecialchars($category);
           $option1 = htmlspecialchars($option1);
           $option2 = htmlspecialchars($option2);
          $amount = htmlspecialchars($amount);
           $endtime = htmlspecialchars($endtime);
                $fundaddr = htmlspecialchars($fundaddr);



           $sql = "SELECT * FROM `proposals` WHERE `pdesc` = '".$pdesc."' OR `title` = '".$title."' LIMIT 1;";
           $result = $conn->query($sql);

           if ($result->num_rows > 0) {
           die('{"success":false, "data": "This Propsal already exist before"}');
           }
          $sql = "INSERT INTO `proposals`( `pdesc`, `addr`, `option1`,`option2`,`endtime`,`amount`,`fundaddr`,`title`,`category`,`vip`) VALUES ('".$pdesc."','".$_SESSION["addr"]."','".$option1."','".$option2."','".$endtime."','".$amount."','".$fundaddr."','".$title."','".$category."','".$vip."')";

          $result = $conn->query($sql);
          // discord


          $hookObject = json_encode([
              "username" => "Idena.vote",
              "avatar_url" => "https://robohash.org/".$_SESSION['username'],
              "tts" => false,
              "embeds" => [
                  [
                      "title" => 'New Proposl : '.$title,
                      "url" => $url.'proposl.php?id='.$conn->insert_id,
                      "type" => "rich",
                      "timestamp" => gmdate("Y-m-d\TH:i:s\Z"),
                      "color" => hexdec( "FFFFFF" ),
                      "author" => [
                          "name" => 'User : '.$_SESSION['username'],
                          "url" => $url.'profile.php?user='.$_SESSION['username']
                      ]
                  ]
              ]

          ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

          $ch = curl_init();

          curl_setopt_array( $ch, [
              CURLOPT_URL => $hook,
              CURLOPT_POST => true,
              CURLOPT_POSTFIELDS => $hookObject,
              CURLOPT_HTTPHEADER => [
                  "Content-Type: application/json"
              ]
          ]);

          $response = curl_exec( $ch );
          curl_close( $ch );
// end discord

          $sql = "UPDATE `accounts` SET `credits` = `credits`-".$cost." WHERE `accounts`.`address` = '".$_SESSION["addr"]."';";

         $conn->query($sql);
          echo '{"success":true,"data":"Proposl created successfully"}';
        } else {
          echo '{"success":false,"data":"This is not proposal"}';
        }
} else {
    echo '{"success":false,"data":"You need to be signed in"}';
}

?>
