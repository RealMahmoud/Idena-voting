<?php
require './vendor/autoload.php';
include("_config.php");
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

if (empty($data['token'])){
die();
};
if (empty($data['signature'])){
die();
};

$sql = "SELECT * FROM `auth` WHERE `token` = '".$data['token']."' LIMIT 1;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $address   = $row['addr'];
    $message   = 'signin-'.$row['nonce'];

    $signature = $data['signature'];

    if (verifySignature($message, $signature, $address)) {
      $sql = "UPDATE `auth` SET `sig` = '".$data['signature']."', `authenticated` = 1 WHERE `token` = '".$data['token']."';";
      $conn->query($sql);

      echo '{"success":true,"data":{"authenticated":true}}';

    } else {
      echo '{"success":true,"data":{"authenticated":false}}';
    }


  }
} else {
    echo '{"success":false,"error":"Trying to hack us?"}';
}


$conn->close();

?>
