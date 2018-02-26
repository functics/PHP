<?php

// 本例中将把 volume 降序排列，把 edition 升序排列。

$data[] = array('volume' => 67, 'edition' => 2);
$data[] = array('volume' => 86, 'edition' => 1);
$data[] = array('volume' => 85, 'edition' => 6);
$data[] = array('volume' => 98, 'edition' => 2);
$data[] = array('volume' => 86, 'edition' => 6);
$data[] = array('volume' => 67, 'edition' => 7);

// 现在有了包含有行的数组，但是 array_multisort() 需要一个包含列的数组，因此用以下代码来取得列，然后排序。

$volume  = array();
$edition = array();

// 取得列的列表
foreach ($data as $key => $value) {
    $volume[$key]  = $value['volume'];
    $edition[$key] = $value['edition'];
}

// 将数据根据 volume 降序排列，根据 edition 升序排列

// 把 $data 作为最后一个参数，以通用键排序

array_multisort($volume, SORT_ASC, $edition, SORT_DESC, $data);

print_r($data);