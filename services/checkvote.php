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
