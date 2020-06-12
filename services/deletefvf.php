<?php
session_start();
include(dirname(__FILE__)."/../common/protected.php");
header('Content-Type: application/json');

$id = $conn->real_escape_string($_GET['id']);

if(!empty($id)){
  $result = $conn->query("SELECT `addtime` from `fvfs` WHERE `id` = '".$id."'");
  $row = $result->fetch_row();
 if (date(strtotime('now - 1 hour')) > Date(strtotime($row[0]))){
   $sql = "UPDATE `accounts` SET `credits` = `credits` + 1 WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1 ;";
   $result = $conn->query($sql);
 }

                    $sql = "DELETE from `fvfs` WHERE `id` = '".$id."' AND `addr` ='".$_SESSION["addr"]."';";
                    $result = $conn->query($sql);
                    $sql = "DELETE FROM `votes` WHERE `votes`.`pid` = '".$id."' AND `type` = 'fvf';";
                    $result = $conn->query($sql);

                    echo '{"status": "success"}';


}
?>
