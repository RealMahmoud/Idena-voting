<?php
session_start();
include(dirname(__FILE__)."/../common/_config.php");
header('Content-Type: application/json');
$polls = array();
$entries = array();
?>
<?php
$sql1 = "SELECT `id` ,`pdesc`, (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE (`state` = 'Verified' OR `state` = 'Human' OR `state` = 'Newbie')AND `type` = 'poll' AND `pid`= `polls`.`id` )AS 'count' FROM polls ORDER BY (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `state` = 'Verified' AND `type` = 'poll' AND `pid`= `polls`.`id`) DESC";
    $result_acct = $conn->query($sql1);
    if ($result_acct->num_rows > 0) {
        // output data of each row
                while($row = $result_acct->fetch_assoc()) {
                    $polls[] = array('description' => mb_strimwidth($row['pdesc'], 0, 25, '...'),'id' => $row['id'],'count' => $row['count']);
                }

    }
    $entries = $result = array('entries' => $polls);
    echo json_encode($entries);
?>
