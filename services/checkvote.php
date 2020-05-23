<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
include(dirname(__FILE__)."/../common/protected.php");
header('Content-Type: application/json');

$id = $conn->real_escape_string($_GET['id']);
$type = $conn->real_escape_string($_GET['type']);
if(!empty($id)){
        $sql = "SELECT * FROM `votes` WHERE `addr` = '".$_SESSION["addr"]."' AND `pid` = '".$id."' AND `type` = 'proposal' LIMIT 1;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    $sql = "SELECT * FROM `".$type."s` WHERE `id` = '".$row["pid"]."' LIMIT 1;";
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
