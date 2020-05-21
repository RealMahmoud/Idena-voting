<?php
include_once(dirname(__FILE__)."/../common/_config.php");

// Take the raw data from the request
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
header('Content-Type: application/json');
?>
{"success":true,"data":{"nonce":"signin-<?php echo $nonce; ?>"}}