<?php
include_once(dirname(__FILE__)."/../common/_config.php");
require_once(dirname(__FILE__)."/../vendor/autoload.php");
use Elliptic\EC;
use kornrunner\Keccak;
use Web3p\RLP\RLP;

function pubKeyToAddress($pubkey) {
    return "0x" . substr(Keccak::hash(substr(hex2bin($pubkey->encode("hex")), 1), 256), 24);
}

function verifySignature($message, $signature, $address) {
   $rlp = new RLP;
    $hash   = Keccak::hash(hex2bin("ab".bin2hex($message)), 256);
    $sign   = ["r" => substr($signature, 2, 64),
               "s" => substr($signature, 66, 64)];
    $recid  = ord(hex2bin(substr($signature, 130, 2)));
    if ($recid != ($recid & 1))
        return false;
    $ec = new EC('secp256k1');
    $pubkey = $ec->recoverPubKey($hash, $sign, $recid);
    return $address == pubKeyToAddress($pubkey);
}


$json = file_get_contents('php://input');
$data = (array) json_decode($json);
$dataToken = $conn->real_escape_string($data['token']);
$dataSig = $conn->real_escape_string($data['signature']);

if (empty($dataToken)){
die();
};
if (empty($dataSig)){
die();
};

$sql = "SELECT * FROM `auth` WHERE `token` = '".$dataToken."' LIMIT 1;";
$result = $conn->query($sql);
header('Content-Type: application/json');

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $address   = $row['addr'];
    $message   = 'signin-'.$row['nonce'];
    $signature = $data['signature'];

    if (verifySignature($message, $signature, $address)) {
      $sql = "UPDATE `auth` SET `sig` = '"$dataSig."', `authenticated` = 1 WHERE `token` = '".$dataToken."' LIMIT 1;";

      $conn->query($sql);

        $sql1 = "SELECT `username` FROM `accounts` WHERE `address` = '".$address."' LIMIT 1;";
        $result_acct = $conn->query($sql1);

        if ($result_acct->num_rows == 0) {
                $t=time();
                $timestamp = date("yy-m-d h:m:s",$t);
                $sql2 = "INSERT INTO `accounts` (`address`, `lastlogin`, `votescount`, `state`, `username`,`password`) VALUES
    ('".$address."', '".$timestamp."', 0, 'zero', '".mb_strimwidth($address, 0, 10, '')."','".substr(str_shuffle("qwertyuiopasdfghjklzxcvbnm"),0,20)."');";

                $result2 = $conn->query($sql2);
        }
      echo '{"success":true,"data":{"authenticated":true}}';

    } else {echo '{"success":true,"data":{"authenticated":false}}';}


  }
} else {echo '{"success":false,"error":"Trying to hack us?"}';}

$conn->close();
?>
