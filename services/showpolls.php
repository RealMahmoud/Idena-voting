<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
header('Content-Type: application/json');
$addr = $conn->real_escape_string($_GET['addr']);
$polls = array();
$entries = array();
?>
<?php
if(!empty($addr)) {
    $sql1 = "SELECT * FROM `polls` WHERE `addr` = '".$addr."'";
    $result_acct = $conn->query($sql1);
    if ($result_acct->num_rows > 0) {
        // output data of each row
                while($row = $result_acct->fetch_assoc()) {
<<<<<<< HEAD
                    $polls[] = array('description' => mb_strimwidth($row['pdesc'], 0, 35, '...'),'id' => $row['id']);
=======
                    $polls[] = array('description' => $row['pdesc'],'id' => $row['id']);
>>>>>>> 78e6e37aeff63cd7d064f13e7ae0ff878036ccb1
                }
                $entries = $result = array('entries' => $polls);
                echo json_encode($entries);
    }
}
?>
