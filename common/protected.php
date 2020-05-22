<?php
function curl_get($url){
    $cURLConnection = curl_init();

    curl_setopt($cURLConnection, CURLOPT_URL, $url);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

    $data = curl_exec($cURLConnection);
    curl_close($cURLConnection);
<<<<<<< HEAD

    return json_decode($data,true);
}

if (!empty($inn_token)){
  $_SESSION["token"] =  $conn->real_escape_string($_GET['token']);
=======
    
    return json_decode($data,true);
}
$inn_token = $conn->real_escape_string($_GET['token']);

if (!empty($inn_token)){
  $_SESSION["token"] = $inn_token;
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
}

$token = $_SESSION["token"];

if(!empty($token)) {
<<<<<<< HEAD

    $sql = "SELECT * FROM `auth` WHERE `token` = '".$token."' LIMIT 1;";
    $result = $conn->query($sql);

=======
    
    $sql = "SELECT * FROM `auth` WHERE `token` = '".$token."' LIMIT 1;";
    $result = $conn->query($sql);
    
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
    if ($result->num_rows > 0) {
      // output data of each row
          while($row = $result->fetch_assoc()) {
            $auth = $row['authenticated'];
<<<<<<< HEAD

                if ($auth == 0){
                    header("location:signin.php");
=======
        
                if ($auth == 0){
                    header("location:index.php");
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
                } else {
                    $addr = $row['addr'];
                    $_SESSION["addr"] = $addr;
                }
         }
<<<<<<< HEAD

    }

    if(empty($addr)) {
        header("location:signin.php");
    }


    if(!empty($addr)) {
        $identity_url = 'https://api.idena.org/api/identity/'.$addr;

=======
    
    }
    
    if(empty($addr)) {
        header("location:index.php");
    }

    
    if(!empty($addr)) {
        $identity_url = 'https://api.idena.org/api/identity/'.$addr;
    
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
        $jsonArrayResponse = curl_get($identity_url);
        if(!empty($jsonArrayResponse)){
            $_SESSION["state"] = $jsonArrayResponse["result"]["state"];
            $state =  $_SESSION["state"];
        }
<<<<<<< HEAD

=======
        
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
        $age_url = 'https://api.idena.org/api/identity/'.$addr.'/age';
        $jsonArrayResponse = curl_get($age_url);
        if(!empty($jsonArrayResponse)){
            $_SESSION["age"] = $jsonArrayResponse["result"];
            $age =  $_SESSION["age"];
        }
<<<<<<< HEAD

        $sql2 = "SELECT `username`,`status` FROM `accounts` WHERE `address` = '".$addr."' LIMIT 1;";
        $result_acct2 = $conn->query($sql2);

=======
        
        $sql2 = "SELECT `username`,`status` FROM `accounts` WHERE `address` = '".$addr."' LIMIT 1;";
        $result_acct2 = $conn->query($sql2);
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
        // fetch and update the lastest state with new login
        if ($result_acct2->num_rows > 0) {
                $sql3 = "UPDATE `accounts` SET `status` = '".$state."' WHERE `address` = '".$addr."' LIMIT 1;";
                $result3 = $conn->query($sql3);
        }
<<<<<<< HEAD


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
=======
    }

} elseif (empty($token)){
    header("location:index.php");
}

?>
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
