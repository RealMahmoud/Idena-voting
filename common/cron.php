<?php


$sql = "UPDATE `accounts` SET `credits` =  5 , `dailyCredits` = '".date("Y-m-d")."' WHERE `accounts`.`state` = 'Human' AND  `accounts`.`banned` = '0'  AND `credits`< 5 AND`dailyCredits` < '".date("Y-m-d")."';";
$conn->query($sql);

$sql = "UPDATE `accounts` SET `credits` =  3 , `dailyCredits` = '".date("Y-m-d")."' WHERE `accounts`.`state` = 'Verified'  AND  `accounts`.`banned` = '0' AND `credits`< 3 AND `dailyCredits` < '".date("Y-m-d")."';";
$conn->query($sql);

$sql = "UPDATE `accounts` SET `credits` =  1 , `dailyCredits` = '".date("Y-m-d")."' WHERE `accounts`.`state` = 'Newbie'  AND  `accounts`.`banned` = '0' AND `credits`< 1 AND `dailyCredits` < '".date("Y-m-d")."';";
$conn->query($sql);


$sql = "DELETE FROM `auth` WHERE `time` < DATE_SUB(NOW(), INTERVAL 1 HOUR);";
$conn->query($sql);



?>
