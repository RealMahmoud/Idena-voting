<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
include(dirname(__FILE__)."/../common/protected.php");
header('Content-Type: application/json');

$id = $conn->real_escape_string($_GET['id']);

if(!empty($id)){
        $sql = "SELECT * FROM `votes` WHERE `addr` = '".$addr."' AND `pid` = '".$id."' LIMIT 1;";
        $result = $conn->query($sql);
<<<<<<< HEAD

        if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    // get poll option desc
                    $sql = "SELECT * FROM `polls` WHERE `id` = '".$row["pid"]."' LIMIT 1;";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                    while($row2 = $result->fetch_assoc()) {
                    echo '{"status": "true", "vote": "'.$row2["option".$row["vote"]].'"}'; }}

                  }
        } else {
           echo '{"status": "false", "data": "0"}';
        }
}
?>
=======
        
        if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                  echo '{"status": "voted", "vote": '.$row["vote"].'}';
                  }
        } else {
           echo '{"status": "none", "data": "no vote yet"}';
        }
}
?>
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
