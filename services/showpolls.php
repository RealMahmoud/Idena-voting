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
                    $polls[] = array('description' => $row['pdesc'],'id' => $row['id']);
                }
                $entries = $result = array('entries' => $polls);
                echo json_encode($entries);
    }
}
?>
