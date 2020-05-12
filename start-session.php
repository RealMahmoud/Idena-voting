<?php
include("_config.php");

// Takes raw data from the request
$json = file_get_contents('php://input');

// Converts it into a PHP object
$data = (array) json_decode($json);
 function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}
$nonce = GUID();
if ($data['token'] == ''){
die();
};
if ($data['address'] == ''){
die();
};
$sql = "INSERT INTO auth (nonce,token, addr)
VALUES ('".$nonce."', '".$data['token']."', '".$data['address']."')";
$conn->query($sql);


$conn->close();

?>
{"success":true,"data":{"nonce":"signin-<?php echo $nonce; ?>"}}
