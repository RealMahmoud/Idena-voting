<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
header('Content-Type: application/json');
$polls = array();
$entries = array();
?>
<?php
    $sql1 = "SELECT * FROM `proposals`";
    $result_acct = $conn->query($sql1);
    if ($result_acct->num_rows > 0) {
        // output data of each row
                while($row = $result_acct->fetch_assoc()) {
                    $polls[] = array('description' => mb_strimwidth($row['pdesc'], 0, 35, '...'),'id' => $row['id'],'addr' => $row['addr']);
                }

    }
    $entries = $result = array('entries' => $polls);
    echo json_encode($entries);
?>
