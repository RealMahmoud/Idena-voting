<?php
session_start();

if(!empty($_SESSION["token"])) {
$sql = "SELECT * FROM `auth` WHERE `token` = '".$data['token']."';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $auth   = $row['authenticated'];

if ($auth == 0){
  header("location:login.php");
}

}}
;}
if (empty($_SESSION["token"])){
    header("location:login.php");
}
?>
A BIG NICE
Idea : 1 --Sending with custom payload --- Proposal ID + Answer + Nonce
Do you thing Idena will go to the moon?
<form action="dna://send/v1" method="get" >

<input type="hidden" id="addr" name="address" value="0xb30348813590e02907da79e1c46fba4edca5a2d8">
   <input type="hidden" id="amount" name="amount" value="0.0000000001">
  <input type="radio" id="vote2" name="comment" value="v=1-id=1-n=55"checked>
  <label for="yes">Yes</label><br>
  <input type="radio" id="vote2" name="comment" value="v=1-id=2-n=55">
  <label for="no">NO</label><br>
  <input type="submit" value="Submit">
</form>


Idea 2 : Click and sign in 1
<?php
$url = 'http://voting.rioda.org/Idena-voting';
 function GUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }

    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}
?>
