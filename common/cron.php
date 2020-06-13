<?php


$sql = "UPDATE `accounts` SET `credits` = `credits`+ 5 , `dailyCredits` = '".date("Y-m-d")."' WHERE `accounts`.`state` = 'Human' AND `dailyCredits` < '".date("Y-m-d")."';";
$conn->query($sql);

$sql = "UPDATE `accounts` SET `credits` = `credits`+ 3 , `dailyCredits` = '".date("Y-m-d")."' WHERE `accounts`.`state` = 'Verified' AND `dailyCredits` < '".date("Y-m-d")."';";
$conn->query($sql);

$sql = "UPDATE `accounts` SET `credits` = `credits`+ 1 , `dailyCredits` = '".date("Y-m-d")."' WHERE `accounts`.`state` = 'Newbie' AND `dailyCredits` < '".date("Y-m-d")."';";
$conn->query($sql);



?>
