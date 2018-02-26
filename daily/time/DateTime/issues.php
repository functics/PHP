<?php

$date = new DateTime();

$date->setTimezone(new DateTimeZone('Asia/Shanghai')); // 设置时区

//$now = $date->timezone;  // notice
//var_dump($now);          // null

print_r($date);

$now = $date->timezone;

echo $now;



/*
 this is a bug  https://bugs.php.net/bug.php?id=75232
 */

