<?php

$date = new DateTime();
$date->setTimezone(new DateTimeZone('Asia/Shanghai')); // 设置时区

// format
echo $date->format('Y-m-d H:i:s') . PHP_EOL;

// add
$date->add(new DateInterval('P10D'));
echo $date->format('Y-m-d H:i:s') . PHP_EOL;

// createFromFormat
$time = DateTime::createFromFormat('Y/m/d H:i:s', '2009/02/15 15:16:17');
print_r($time); //  DateTime Object ( [date] => 2009-02-15 15:16:17.000000 [timezone_type] => 3 [timezone] => UTC )

// getLastErrors
try {
    $date1 = new DateTime('asdfasdf');
} catch (Exception $e) {
    print_r(DateTime::getLastErrors());
}

// modify
$date->modify('+10 days');
echo $date->format('Y-m-d H:i:s') . PHP_EOL;

// __set_state
//print_r(DateTime::__set_state((array)$date));

// setDate
$date->setDate('2018', '01', '02');
echo $date->format('Y-m-d H:i:s') . PHP_EOL;

// setISODate
$date->setISODate('2018', '01', '1');
echo $date->format('Y-m-d H:i:s') . PHP_EOL;

// setTime
$date->setTime(10, 25, 59); // A 4th parameter has been added in PHP-7.1 : microseconds
echo $date->format('Y-m-d H:i:s') . PHP_EOL;

// setTimestamp
$date->setTimestamp(time());
echo $date->format('Y-m-d H:i:s') . PHP_EOL;

// sub
$date->sub(new DateInterval('P1Y'));
echo $date->format('Y-m-d H:i:s') . 'sub' . PHP_EOL;

// diff
$datetime1 = new DateTime('2009-10-11');
$datetime2 = new DateTime('2008-10-09');
$interval = $datetime1->diff($datetime2);
echo $interval->format('%R%Y years %R%m months %R%a days') . PHP_EOL; // todo: months有问题


// getOffset  prc 与 utc 相差八小时
echo $date->getOffset() . PHP_EOL;  // Note: -18000 = -5 hours, -14400 = -4 hours. 返回UTC成功时的时区偏移

// getTimestamp
echo $date->getTimestamp() . PHP_EOL;

//  getTimezone
print_r($date->getTimezone());
