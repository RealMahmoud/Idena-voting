<?php
include(dirname(__FILE__)."/_public.php");

$sql = "UPDATE `accounts` SET `credits` =  5 , `dailyCredits` = '".date("Y-m-d")."' WHERE `accounts`.`state` = 'Human' AND  `accounts`.`banned` = '0'  AND `credits`< 5 AND`dailyCredits` < '".date("Y-m-d")."';";
$conn->query($sql);

$sql = "UPDATE `accounts` SET `credits` =  3 , `dailyCredits` = '".date("Y-m-d")."' WHERE `accounts`.`state` = 'Verified'  AND  `accounts`.`banned` = '0' AND `credits`< 3 AND `dailyCredits` < '".date("Y-m-d")."';";
$conn->query($sql);

$sql = "UPDATE `accounts` SET `credits` =  1 , `dailyCredits` = '".date("Y-m-d")."' WHERE `accounts`.`state` = 'Newbie'  AND  `accounts`.`banned` = '0' AND `credits`< 1 AND `dailyCredits` < '".date("Y-m-d")."';";
$conn->query($sql);


$sql = "DELETE FROM `auth` WHERE `time` < DATE_SUB(NOW(), INTERVAL 1 HOUR);";
$conn->query($sql);




$sql2 = "SELECT * , (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE (`state` = 'Verified' OR `state` = 'Human' OR `state` = 'Newbie') AND `type` = 'proposal' AND `pid`= `proposals`.`id` )AS 'count' FROM proposals WHERE (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `type` = 'proposal' AND `pid`= `proposals`.`id`) > 9 AND `ann` = '0' AND`endtime` > NOW() ORDER BY (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `type` = 'proposal' AND `pid`= `proposals`.`id`) DESC LIMIT 50";
$result_acct = $conn->query($sql2);
if ($result_acct->num_rows > 0) {
while($row = $result_acct->fetch_assoc()) {
$result = $conn->query("SELECT `pic`,`username` FROM `accounts` WHERE `address` = '".$row['addr']."';");
$rowk = $result->fetch_row();
$sql = "UPDATE `proposals` SET `ann` =  1 WHERE `id` = '".$row['id']."'";
$conn->query($sql);
$hookObject = json_encode([
    "username" => "Idena.vote",
    "avatar_url" => "https://robohash.org/".$rowk[0],
    "tts" => false,
    "embeds" => [
        [
            "title" => 'Hot Proposal : '.$row['title'],
            "url" => $url.'proposal.php?id='.$row['id'],
            "type" => "rich",
            "timestamp" => $row['addtime'],
            "color" => 3066993,
            "author" => [
                "name" => 'User : '.$rowk[1],
                "url" => $url.'profile.php?user='.$rowk[1]
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

$ch = curl_init();

curl_setopt_array( $ch, [
    CURLOPT_URL => $hook,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);

$response = curl_exec( $ch );
curl_close( $ch );
// end discord
}}













$sql2 = "SELECT * , (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE (`state` = 'Verified' OR `state` = 'Human' OR `state` = 'Newbie') AND `type` = 'poll' AND `pid`= `polls`.`id` )AS 'count' FROM polls WHERE (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `type` = 'poll' AND `pid`= `polls`.`id`) > 9 AND `ann` = '0' AND`endtime` > NOW() ORDER BY (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `type` = 'poll' AND `pid`= `polls`.`id`) DESC LIMIT 50";
$result_acct = $conn->query($sql2);
if ($result_acct->num_rows > 0) {
while($row = $result_acct->fetch_assoc()) {
$result = $conn->query("SELECT `pic`,`username` FROM `accounts` WHERE `address` = '".$row['addr']."';");
$rowk = $result->fetch_row();
$sql = "UPDATE `polls` SET `ann` =  1 WHERE `id` = '".$row['id']."'";
$conn->query($sql);
$hookObject = json_encode([
    "username" => "Idena.vote",
    "avatar_url" => "https://robohash.org/".$rowk[0],
    "tts" => false,
    "embeds" => [
        [
            "title" => 'Hot poll : '.$row['title'],
            "url" => $url.'poll.php?id='.$row['id'],
            "type" => "rich",
            "timestamp" => $row['addtime'],
            "color" => 15105570,
            "author" => [
                "name" => 'User : '.$rowk[1],
                "url" => $url.'profile.php?user='.$rowk[1]
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

$ch = curl_init();

curl_setopt_array( $ch, [
    CURLOPT_URL => $hook,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);

$response = curl_exec( $ch );
curl_close( $ch );
// end discord
}}



$sql2 = "SELECT * , (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE (`state` = 'Verified' OR `state` = 'Human' OR `state` = 'Newbie') AND `type` = 'fvf' AND `pid`= `fvfs`.`id` )AS 'count' FROM fvfs WHERE (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `type` = 'fvf' AND `pid`= `fvfs`.`id`) > 9 AND `ann` = '0' AND`endtime` > NOW() ORDER BY (SELECT COUNT(*) FROM `accounts` INNER JOIN `votes` ON `accounts`.`address`=`votes`.`addr` WHERE `type` = 'fvf' AND `pid`= `fvfs`.`id`) DESC LIMIT 50";
$result_acct = $conn->query($sql2);
if ($result_acct->num_rows > 0) {
while($row = $result_acct->fetch_assoc()) {
$result = $conn->query("SELECT `pic`,`username` FROM `accounts` WHERE `address` = '".$row['addr']."';");
$rowk = $result->fetch_row();
$sql = "UPDATE `fvfs` SET `ann` =  1 WHERE `id` = '".$row['id']."'";
$conn->query($sql);
$hookObject = json_encode([
    "username" => "Idena.vote",
    "avatar_url" => "https://robohash.org/".$rowk[0],
    "tts" => false,
    "embeds" => [
        [
            "title" => 'Hot FvF : '.$row['title'],
            "url" => $url.'fvf.php?id='.$row['id'],
            "type" => "rich",
            "timestamp" => $row['addtime'],
            "color" => 10181046,
            "author" => [
                "name" => 'User : '.$rowk[1],
                "url" => $url.'profile.php?user='.$rowk[1]
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

$ch = curl_init();

curl_setopt_array( $ch, [
    CURLOPT_URL => $hook,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);

$response = curl_exec( $ch );
curl_close( $ch );
// end discord
}}
?>
