<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
header('Content-Type: application/json');
$proposals = array();
$entries = array();
?>
<?php
$sql1 = "SELECT `id` ,`pdesc`, (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE (`state` = 'Verified' OR `state` = 'Human' OR `state` = 'Newbie')AND `type` = 'proposal' AND `pid`= `proposals`.`id` )AS 'count' FROM proposals ORDER BY (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `state` = 'Verified' AND `type` = 'proposal' AND `pid`= `proposals`.`id`) DESC LIMIT 50";
    $result_acct = $conn->query($sql1);
    if ($result_acct->num_rows > 0) {
        // output data of each row
                while($row = $result_acct->fetch_assoc()) {
                    $proposals[] = array('description' => mb_strimwidth($row['pdesc'], 0, 25, '...'),'id' => $row['id'],'count' => $row['count']);
                }

    }
    $entries = $result = array('entries' => $proposals);
    echo json_encode($entries);
?>
