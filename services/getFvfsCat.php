<?php
session_start();
include(dirname(__FILE__)."/../common/_public.php");
header('Content-Type: application/json');
$fvfs = array();
$entries = array();


$sql1 = 'SELECT DISTINCT `category` FROM `fvfs`;';


    $result_acct = $conn->query($sql1);
    if ($result_acct->num_rows > 0) {
        // output data of each row
                while($row = $result_acct->fetch_assoc()) {
                  $resultx = $conn->query("SELECT COUNT(*) FROM `fvfs` WHERE `category` = '".$row['category']."';");
                  $rowx = $resultx->fetch_row();
                  $count = $rowx[0];

                    $fvfs[] = array('category' =>  $row['category'],'count'=> $count);
                }

    }
    $entries = $result = array('entries' => $fvfs);
    echo json_encode($entries);




?>
