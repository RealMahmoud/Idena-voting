<?php
session_start();
include(dirname(__FILE__)."/../common/protected.php");
header('Content-Type: application/json');

$id = $conn->real_escape_string($_GET['id']);

if(!empty($id)){

                    $sql = "DELETE from `polls` WHERE `id` = '".$id."' AND `addr` = '".$_SESSION["addr"]."';";
                    $result = $conn->query($sql);
                    $sql = "DELETE FROM `votes` WHERE `votes`.`pid` = '".$id."' AND `type` = 'poll';";
                    $result = $conn->query($sql);
                    echo '{"status": "success"}';


}
?>
