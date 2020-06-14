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

  if(empty($conn->real_escape_string($_POST['location1']))) {
    die('{"success":false,"data":"No location 1"}');
  }
  if(empty($conn->real_escape_string($_POST['location2']))) {
    die('{"success":false,"data":"No location 2 "}');
  }


if(!empty($_SESSION["addr"]))
{
        if ($_POST['type'] == 'fvf'){
          $addr = $conn->real_escape_string($_SESSION["addr"]);
          $location1 = $conn->real_escape_string($_POST['location1']);
          $location2 = $conn->real_escape_string($_POST['location2']);
          $endtime= $conn->real_escape_string($_POST['endtime']);
          $pdesc = $conn->real_escape_string($_POST['desc']);
          $title = $conn->real_escape_string($_POST['title']);
          $category = $conn->real_escape_string($_POST['category']);
          $fundaddr = $conn->real_escape_string($_POST['fundaddr']);
          $vip = $conn->real_escape_string($_POST['vip']);


          $addr = $conn->htmlspecialchars($addr);
          $location1 = $conn->htmlspecialchars($location1);
          $location2 = $conn->htmlspecialchars($location2);
          $endtime= $conn->htmlspecialchars($endtime);
          $pdesc = $conn->htmlspecialchars($pdesc);
          $title = $conn->htmlspecialchars($title);
          $category = $conn->htmlspecialchars($category);
          $fundaddr = $conn->htmlspecialchars($fundaddr);
          $vip = $conn->htmlspecialchars($vip);





          $sql = "SELECT * FROM `fvfs` WHERE `pdesc` = '".$pdesc."' OR `title` = '".$title."' LIMIT 1;";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
          die('{"success":false, "data": "This FvF already exist before"}');
          }
          $sql = "INSERT INTO `fvfs`( `addr`, `location1`, `location2`,`endtime`, `pdesc`, `fundaddr` ,  `title`,`category`,`vip`) VALUES ('".$addr."','".$location1."','".$location2."','".$endtime."','".$pdesc."','".$fundaddr."' ,'".$title."','".$category."','".$vip."')";

          $result = $conn->query($sql);
          // discord


          $hookObject = json_encode([
              "username" => "Idena.vote",
              "avatar_url" => "https://robohash.org/".$_SESSION['username'],
              "tts" => false,
              "embeds" => [
                  [
                      "title" => 'New FvF : '.$title,
                      "url" => $url.'fvf.php?id='.$conn->insert_id,
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
          echo '{"success":true,"data":"Fvf Created successfully"}';
        } else {
          echo '{"success":false,"data":"No EndTime"}';
        }
} else {
    echo '{"success":false,"data":"Need to be signed in"}';
}

?>
