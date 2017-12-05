<?php

$res = array(
    array('title'=>'设置','url'=>'','parent'=>''),
    array('title'=>'系统设置','url'=>'','parent'=>'设置'),
    array('title'=>'基本设置','url'=>'','parent'=>'设置'),
    array('title'=>'店铺设置','url'=>'','parent'=>'基本设置'),
    array('title'=>'仓库设置','url'=>'','parent'=>'基本设置'),
    array('title'=>'物流设置','url'=>'','parent'=>'基本设置'),
    array('title'=>'安全设置','url'=>'','parent'=>'设置'),
    array('title'=>'采购','url'=>'','parent'=>''),
);

$data = array(
    "menu" => array(
        array(
            "title" => "主菜单",
            "menu"  => array(
                array(
                    "title" => "一级",
                    "menu"  => array(
                        array(
                            "title" => "二级",
                            "menu"  => array(
                                array(
                                    "title" => "三级",
                                    "menu"  => array()
                                )
                            )
                        )
                    )
                )
            )
        )
    )
);

function menuFormat($menu) {

    $container = array();// 声明返回菜单数组
    $caption   = array();// 菜单

    foreach ($menu as $value) {
        $caption[] = array(
            "title"  => $value["title"],
            "parent" => $value["parent"],
            "menu"   => array()
        );
    }

    $count = count($caption);

    for ($i = 0; $i < $count; $i ++) {
        for ($j = 0, $k = 0; $j < $count; $j ++) {

            if ($i === $j) continue;
            // 找最底层
            $x = $caption[$i]['parent'] !== '';
            $y = $caption[$i]['title']  !== $caption[$j]['parent'];
            $z = $caption[$i]['parent'] === $caption[$j]['title'];

            if ($x && $y && $z) {
                $container[$k] = $caption[$j];
                array_push($container[$k]['menu'], $caption[$i]);
                $k ++;
            }
        }
    }

    print_r($container);
//    print_r($caption);
}

menuFormat($res);