<?php
include(dirname(__FILE__)."/../common/_public.php");

$data = curl_get('https://api.idena.org/api/address/0xa27Da2afE2C8e9866Ea143b7F495868346090007/txs/count');
$result = $conn->query("SELECT COUNT(*) FROM `payments`");
$row = $result->fetch_row();
if($data > $row[0]){

$txsData = curl_get('https://api.idena.org/api/address/0xa27Da2afE2C8e9866Ea143b7F495868346090007/txs?limit='.(intval($data['result']) - (intval($row[0]))).'&skip=0');


foreach($txsData['result'] as $key => $value) {

  $hookObject = json_encode([
    "method"=> "bcn_transaction",
    "id"=> 2,
    "params"=> [$value['hash']]
  ]);

  $ch = curl_init();

  curl_setopt_array( $ch, [
      CURLOPT_URL => 'https://rpc.idena.dev',
      CURLOPT_POST => true,
      CURLOPT_POSTFIELDS => $hookObject,
      CURLOPT_HTTPHEADER => [
          "Content-Type: application/json"
      ]
  ]);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$data =  curl_exec( $ch );
$data = json_decode($data, true);
  curl_close( $ch );

  if($data['result']['to'] == '0xa27da2afe2c8e9866ea143b7f495868346090007'){




$conn->query("UPDATE `accounts` SET `credits` =  `credits` + '".intval($data['result']['amount']) / 0.25."' where `address` = '".hex2bin(substr($data['result']['payload'],2))."'");
   $conn->query("INSERT INTO `payments`(`sender`, `amount`, `paid`,`credits`,`hash`,`account`) VALUES (
     '".$data['result']['from']."',
     '".intval($data['result']['amount'])."',
     '1',
     '".intval($data['result']['amount']) / 0.25."',
     '".$data['result']['hash']."',
     '".hex2bin(substr($data['result']['payload'],2))."');");




  }
}


}




?>
