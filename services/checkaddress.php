<?php
session_start();
include(dirname(__FILE__)."/../common/_public.php");
header('Content-Type: application/json');

if(isset($_GET['user'])){
  $username = $conn->real_escape_string($_GET['user']);
}else{
  $username = '';
}


$sql1 = "SELECT `address`, `hidden` FROM `accounts` WHERE `username` = '".$username."' LIMIT 1;";
$result_acct = $conn->query($sql1);
if ($result_acct->num_rows > 0) {
    // output data of each row
        while($row = $result_acct->fetch_assoc()) {

          $hidden =  $row['hidden'];
          $address = $row['address'];

    }
if(isset($_SESSION['addr'])){
  $addressu = $_SESSION['addr'];
}else{
  $addressu = 'none';
}
    if($hidden == 1  || $address == $addressu){
        echo '{"address":"'.$address.'"}';
    }else{
        echo '{"address":" - "}';
    }

}else{
    echo '{"address":" Private "}';
}
?>
