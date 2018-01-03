<?php

$start    = new DateTime();
$interval = new DateInterval('P2W');
$period   = new DatePeriod($start, $interval, 6);

//print_r($period);

foreach ($period as $nextDateTime) {
    echo $nextDateTime->format('Y-m-d H:i:s'), PHP_EOL;
}