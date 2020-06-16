<?php
session_start();
include(dirname(__FILE__)."/../common/_public.php");
header('Content-Type: application/json');

$password = $conn->real_escape_string($_POST['password']);

if(!empty($password) && empty($_SESSION["addr"])){
$sql = "SELECT * FROM `accounts` WHERE `password` = '".$password."' LIMIT 1;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data  Of each row
  while($row = $result->fetch_assoc()) {

  $_SESSION["addr"] = $row['address'];
  $_SESSION["state"] = $row['state'];
//score  $_SESSION["score"] = $row['score'];
$_SESSION["password"] = $row['password'];
$_SESSION["username"] = $row['username'];
if($row['hidden'] == 1 ){

    $_SESSION["hidden"] = 'True';
}else{
  $_SESSION["hidden"] = 'False';
}

  $_SESSION["credits"] = $row['credits'];
    $_SESSION["pic"] = $row['pic'];

  $_SESSION["age"] = $row['age'];

 echo '{"success":true}';


}

}else{
    echo '{"success":false, "data": "ERROR"}';
}

}else {
  echo '{"success":false, "data": "ERROR"}';
}
?>
