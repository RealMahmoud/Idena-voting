<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
header('Content-Type: application/json');

$password = $conn->real_escape_string($_POST['password']);

if(!empty($password) && empty($_SESSION["addr"])){
$sql = "SELECT * FROM `accounts` WHERE `password` = '".$password."' LIMIT 1;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data  Of each row
  while($row = $result->fetch_assoc()) {

  $_SESSION["addr"] = $row['address'];
 echo '{"success":true}';


}

}else{
    echo '{"success":false}';
}}
?>
