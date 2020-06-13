<?php
session_start();
if(empty($_SESSION["addr"])){
  die('{"status": "login", "data": "0"}');
}

include(dirname(__FILE__)."/../common/protected.php");
header('Content-Type: application/json');

$id = $conn->real_escape_string($_GET['id']);
$type = $conn->real_escape_string($_GET['type']);
if(!empty($id)){
        $sql = "SELECT * FROM `votes` WHERE `addr` = '".$_SESSION["addr"]."' AND `pid` = '".$id."' AND `type` = '".$type."' LIMIT 1;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    $sql = "SELECT * FROM `".$type."s` WHERE `id` = '".$row["pid"]."' LIMIT 1;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                    while($row2 = $result->fetch_assoc()) {
                      if(Date(strtotime('now')) > Date(strtotime($row2['endtime']))&&isset($_SESSION["addr"])){
                      die('{"status": "ended", "data": "0"}');
                    }
                      if($type == 'fvf'){
                          echo '{"status": "true", "vote": "'.$row["vote"].'"}';
                      }else{
                          echo '{"status": "true", "vote": "'.$row2["option".$row["vote"]].'"}';
                      }

}}
                  }
        } else {




          $sql = "SELECT * FROM `".$type."s` WHERE `id` = '".$id."' LIMIT 1;";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
          while($row2 = $result->fetch_assoc()) {
            if(Date(strtotime('now')) > Date(strtotime($row2['endtime']))&&isset($_SESSION["addr"])){
            die('{"status": "ended", "data": "0"}');
          }else{
            echo '{"status": "false", "data": "0"}';
          }
        }}










        }
}
?>
