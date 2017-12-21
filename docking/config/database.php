<?php

/*
 * 如果为调试模式，则用测试数据库
 * 如果不是调试模式，则用正式数据库
 */

if (DEBUG) {
    return array(
        'host'    => 'xxx.xxx.xxx.xxx',
        'db_user' => 'xxxxxxxxx',
        'db_pwd'  => 'xxxxxxxxx',
        'db_name' => 'xxxxxxxxx',
        'tag'     => 'xxxxxxxxx'
    );
} else {
    return array(
        'host'    => 'xxx.xxx.xxx.xxx',
        'db_user' => 'xxxxxxxxx',
        'db_pwd'  => 'xxxxxxxxx',
        'db_name' => 'xxxxxxxxx',
        'tag'     => 'xxxxxxxxx'
    );
}