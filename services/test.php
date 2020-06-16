<?php

require_once(dirname(__FILE__)."/../vendor/autoload.php");
use Elliptic\EC;
use kornrunner\Keccak;


function pubKeyToAddress($pubkey) {
    return "0x" . substr(Keccak::hash(substr(hex2bin($pubkey->encode("hex")), 1), 256), 24);
}

function verifySignature($message, $signature) {


    $hash   =   Keccak::hash( pack("H*", Keccak::hash(pack("H*", bin2hex($message)), 256))  ,256);

    $sign   = ["r" => substr($signature, 2, 64),
               "s" => substr($signature, 66, 64)];
    $recid  = ord(hex2bin(substr($signature, 130, 2)));
    if ($recid != ($recid & 1))
        return false;
    $ec = new EC('secp256k1');
    $pubkey = $ec->recoverPubKey($hash, $sign, $recid);
    return  pubKeyToAddress($pubkey);
}

echo verifySignature('signin-0652c409-17ef-4ad6-b580-3faaefcc204d', '0xdcb3637135aeddd36c39f99b75b2458036b0ebe0042d506a5361f9193f490b2261f1817ff1a61e115a0d86724308c6455e50729e5a22ed4cdfcee3e92969deb201');
function curl_get($url){
    $cURLConnection = curl_init();

    curl_setopt($cURLConnection, CURLOPT_URL, $url);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

    $data = curl_exec($cURLConnection);
    curl_close($cURLConnection);

    return json_decode($data,true);
}

echo curl_get('/services/checkPic.php?user=Mahmoud');
