<?php
$url = 'https://idena-dev.com/';
$site_name = 'Idena Site';

$servername = "localhost";
$username = "supriyo_root";
$password = "idenaplayground";
$dbname = "supriyo_voting";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

function GUID(){
if (function_exists('com_create_guid') === true)
{return trim(com_create_guid(), '{}');}
return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}
?>