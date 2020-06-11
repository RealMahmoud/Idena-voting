<?php
include(dirname(__FILE__)."/_config.php");
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
          if (date(strtotime('now')) > Date(strtotime($row['lastseen'].' +1 hour')) || $row['state'] == 'zero'){


            $identity_url = 'https://api.idena.org/api/identity/'.$_SESSION["addr"];
            $jsonArrayResponse = curl_get($identity_url);

            if(isset( $jsonArrayResponse['result']["state"])){
              if($jsonArrayResponse['result']["state"] == 'Suspended'){
                $lastepochurl = 'https://api.idena.org/api/epoch/last';
                $jsonlastepoch = curl_get($lastepochurl);
                $prevstateurl = 'https://api.idena.org/api/epoch/'.($jsonlastepoch['result']['epoch'] - 1 ).'/identity/'.$_SESSION["addr"];
                $prevstate = curl_get($prevstateurl);
                $newstate = $prevstate["result"]["prevState"];
              }else{
                $newstate = $jsonArrayResponse['result']["state"];
              }
             }else{
             $newstate = 'zero';
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



          }else{
              $sql3 = "UPDATE `accounts` SET `lastseen`= NOW()  WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";
                $result3 = $conn->query($sql3);
          }
          $sql = "SELECT * FROM `accounts` WHERE `address` = '".$_SESSION["addr"]."' LIMIT 1;";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
          $_SESSION["state"] = $row['state'];
        //score  $_SESSION["score"] = $row['score'];
        $_SESSION["password"] = $row['password'];
        $_SESSION["username"] = $row['username'];
        if($row['hidden'] == 1 ){

            $_SESSION["hidden"] = 'True';
        }else{
          $_SESSION["hidden"] = 'False';
        }

          $_SESSION["credits"] = $row['credits'];
          $_SESSION["age"] = $row['age'];}}


    }

    }
    }


if(empty($_SESSION["addr"])) {
    header("location:signin.php");
}

?>
