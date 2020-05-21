<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
include(dirname(__FILE__)."/../common/protected.php");
header('Content-Type: application/json');

$id = $conn->real_escape_string($_GET['id']);

if(!empty($id)){
        $sql = "SELECT * FROM `votes` WHERE `addr` = '".$addr."' AND `pid` = '".$id."' LIMIT 1;";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                  echo '{"status": "voted", "vote": '.$row["vote"].'}';
                  }
        } else {
           echo '{"status": "none", "data": "no vote yet"}';
        }
}
?>