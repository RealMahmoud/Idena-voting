<?php
function curl_get($url){
    $cURLConnection = curl_init();

    curl_setopt($cURLConnection, CURLOPT_URL, $url);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

    $data = curl_exec($cURLConnection);
    curl_close($cURLConnection);

    return json_decode($data,true);
}

if (!empty($inn_token)){
  $_SESSION["token"] =  $conn->real_escape_string($_GET['token']);
}

$token = $_SESSION["token"];

if(!empty($token)) {

    $sql = "SELECT * FROM `auth` WHERE `token` = '".$token."' LIMIT 1;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
          while($row = $result->fetch_assoc()) {
            $auth = $row['authenticated'];

                if ($auth == 0){
                    header("location:signin.php");
                } else {
                    $addr = $row['addr'];
                    $_SESSION["addr"] = $addr;
                }
         }

    }

    if(empty($addr)) {
        header("location:signin.php");
    }


    if(!empty($addr)) {
        $identity_url = 'https://api.idena.org/api/identity/'.$addr;

        $jsonArrayResponse = curl_get($identity_url);
        if(!empty($jsonArrayResponse)){
            $_SESSION["state"] = $jsonArrayResponse["result"]["state"];
            $state =  $_SESSION["state"];
        }

        $age_url = 'https://api.idena.org/api/identity/'.$addr.'/age';
        $jsonArrayResponse = curl_get($age_url);
        if(!empty($jsonArrayResponse)){
            $_SESSION["age"] = $jsonArrayResponse["result"];
            $age =  $_SESSION["age"];
        }

        $sql2 = "SELECT `username`,`status` FROM `accounts` WHERE `address` = '".$addr."' LIMIT 1;";
        $result_acct2 = $conn->query($sql2);

        // fetch and update the lastest state with new login
        if ($result_acct2->num_rows > 0) {
                $sql3 = "UPDATE `accounts` SET `status` = '".$state."' WHERE `address` = '".$addr."' LIMIT 1;";
                $result3 = $conn->query($sql3);
        }


        $sql = "SELECT * FROM `accounts` WHERE `address` = '".$addr."' LIMIT 1;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        $credits = $row['credits'];
        $username = $row['username'];}}
    }

} elseif (empty($token)){
    header("location:signin.php");
}

?>
