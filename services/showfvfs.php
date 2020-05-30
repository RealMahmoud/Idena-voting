<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
header('Content-Type: application/json');
$fvfs = array();
$entries = array();
?>
<?php
$sql1 = "SELECT `id` ,`pdesc`, (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE (`state` = 'Verified' OR `state` = 'Human' OR `state` = 'Newbie')AND `type` = 'fvf' AND `pid`= `fvfs`.`id` )AS 'count' FROM fvfs  WHERE `addr` = '".$_SESSION["addr"]."' ORDER BY (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `state` = 'Verified' AND `type` = 'fvf' AND `pid`= `fvfs`.`id`) DESC";
    $result_acct = $conn->query($sql1);
    if ($result_acct->num_rows > 0) {
        // output data of each row
                while($row = $result_acct->fetch_assoc()) {
                    $fvfs[] = array('description' => mb_strimwidth($row['pdesc'], 0, 25, '...'),'id' => $row['id'],'count' => $row['count']);
                }

    }
    $entries = $result = array('entries' => $fvfs);
    echo json_encode($entries);
?>
