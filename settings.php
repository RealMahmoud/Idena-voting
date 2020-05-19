<?php
session_start();
include("_config.php");
if (!empty($_GET['token'])){
  $_SESSION["token"] = $_GET['token'];
}

if(!empty($_SESSION["token"])) {
    
    $sql = "SELECT * FROM `auth` WHERE `token` = '".$_SESSION["token"]."';";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
      // output data of each row
          while($row = $result->fetch_assoc()) {
            $auth   = $row['authenticated'];
        
                if ($auth == 0){
                 header("location:signin.php");
                }
         }
    
    }
} elseif (empty($_SESSION["token"])){
    header("location:signin.php");
}

$sql = "SELECT * FROM `auth` WHERE `token` = '".$_SESSION["token"]."';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $addr = $row['addr'];
        }
}
?>



<h2>Hi</h2>

<h4>Change username</h4>
<form action="changeusername.php" method="POST">
<input type="text" name="username" value="" >
<input type="submit" value="submit">
</form>
