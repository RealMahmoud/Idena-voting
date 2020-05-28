<?php
function curl_get($url){
    $cURLConnection = curl_init();

    curl_setopt($cURLConnection, CURLOPT_URL, $url);
    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

    $data = curl_exec($cURLConnection);
    curl_close($cURLConnection);

    return json_decode($data,true);
}




if(!empty($_SESSION["token"])) {

    $sql = "SELECT * FROM `auth` WHERE `token` = '".$_SESSION["token"]."' LIMIT 1;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
          while($row = $result->fetch_assoc()) {
            $auth = $row['authenticated'];

                if ($auth == 0){
                    header("location:signin.php");
                } else {
                    $_SESSION["addr"] = $row['addr'];
                    }
         }

    }
}



    if(!empty($_SESSION["addr"])) {
      $sql = "SELECT * FROM `accounts` WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          if (date(strtotime('now')) > Date(strtotime($row['lastseen'].' +1 hour')) || $row['age'] == '0'){


            $identity_url = 'https://api.idena.org/api/identity/'.$_SESSION["addr"];
            $jsonArrayResponse = curl_get($identity_url);
            if( isset( $jsonArrayResponse['result']["state"])){
              $newstate = $jsonArrayResponse["result"]["state"];
}else{
  $newstate = 'Undefined';
}


            $age_url = 'https://api.idena.org/api/identity/'.$_SESSION["addr"].'/age';
            $jsonArrayResponse = curl_get($age_url);
            if( isset( $jsonArrayResponse['result'])){
              $newage = $jsonArrayResponse["result"];
}else{
  $newage = '0';
}

            // update
            $sql3 = "UPDATE `accounts` SET `state` = '".$newstate."',`age`='".$newage."',`lastseen`= NOW()  WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";

            $result3 = $conn->query($sql3);



          }
          $sql = "SELECT * FROM `accounts` WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
          $_SESSION["state"] = $row['state'];
        //score  $_SESSION["score"] = $row['score'];
        $_SESSION["password"] = $row['password'];
          $_SESSION["age"] = $row['age'];}}


    }

    }
    }


if(empty($_SESSION["addr"])) {
    header("location:signin.php");
}

?>
