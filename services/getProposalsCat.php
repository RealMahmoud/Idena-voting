<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
header('Content-Type: application/json');
$proposals = array();
$entries = array();


$sql1 = 'SELECT DISTINCT `category` FROM `proposals`;';


    $result_acct = $conn->query($sql1);
    if ($result_acct->num_rows > 0) {
        // output data of each row
                while($row = $result_acct->fetch_assoc()) {
                  $resultx = $conn->query("SELECT COUNT(*) FROM `proposals` WHERE `category` = '".$row['category']."';");
                  $rowx = $resultx->fetch_row();
                  $count = $rowx[0];

                    $proposals[] = array('category' =>  $row['category'],'count'=> $count);
                }

    }
    $entries = $result = array('entries' => $proposals);
    echo json_encode($entries);




?>
