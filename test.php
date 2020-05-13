<?php
require './vendor/autoload.php';
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



    $address   = '0xb30348813590e02907da79e1c46fba4edca5a2d8';
    $message   = 'signin-1903e847-8ba8-4953-bdde-751d93319390';

    $signature = '0x68d052c43e89d1f10fcaba1e10e84487f2740e9963e4576343fc35e323e9f1d259e96b7cac74d5b2398693f618e957993d83b1e57df5098a596dbc3876af9fb700';

    if (verifySignature($message, $signature, $address)) {
      echo "success";
    }
?>
