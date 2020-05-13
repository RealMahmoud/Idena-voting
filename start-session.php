<?php
include("_config.php");

// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = (array) json_decode($json);
$nonce = GUID();
if ($data['token'] == ''){die();};
if ($data['address'] == ''){die();};
$sql = "INSERT INTO auth (nonce,token, addr) 
VALUES ('".$nonce."', '".$data['token']."', '".$data['address']."')";
$conn->query($sql);
$conn->close();
?>
{"success":true,"data":{"nonce":"signin-<?php echo $nonce; ?>"}}