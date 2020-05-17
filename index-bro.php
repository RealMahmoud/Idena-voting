<?php
session_start();
include("_config.php");
if (!empty($_GET['token'])){
  $_SESSION["token"] = $_GET['token'];
}
if(!empty($_SESSION["token"])) {
$sql = "SELECT * FROM `auth` WHERE `token` = '".$_SESSION["token"]."';";
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

<?php //fetch latest
echo "<br>Polls : <br>";
$sql = "SELECT * FROM `polls`;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
 echo "<br> Poll ID : ".$row['id']."<br>";
  echo "Description : ".$row['pdesc']."<br>";
  echo "Link : ".$url.'poll.php?id='.$row['id']."<br>";
  }
}
?>
<?php //fetch latest
echo "<br>Projects : <br>";
$sql = "SELECT * FROM `projects`;";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
 echo "<br> Project ID : ".$row['id']."<br>";
  echo "Description : ".$row['pdesc']."<br>";
    echo "Link : ".$url.'project.php?id='.$row['id']."<br>";
  }
}
?>


<a href="logout.php">Logout</a>