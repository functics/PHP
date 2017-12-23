<?php

/*
 * 如果为调试模式，则用测试数据库
 * 如果不是调试模式，则用正式数据库
 */
if (DEBUG) {
    $GLOBALS['g_local_db_config'] = array(
        'host'    => 'xxx.xxx.xxx.xxx',
        'db_user' => 'xxxxxxxxx',
        'db_pwd'  => 'xxxxxxxxx',
        'db_name' => 'xxxxxxxxx',
        'tag'     => 'xxxxxxxxx'
    );
} else {
    $GLOBALS['g_local_db_config'] = array(
        'host'    => 'xxx.xxx.xxx.xxx',
        'db_user' => 'xxxxxxxxx',
        'db_pwd'  => 'xxxxxxxxx',
        'db_name' => 'xxxxxxxxx',
        'tag'     => 'xxxxxxxxx'
    );
}
