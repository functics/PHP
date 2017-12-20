<?php

/**
 * docking入口
 */

// 引入配置文件
require_once __DIR__ . '/../Common/config.php';

// 数据库读取
$g_local_db_config = require COMMON_ROOT . 'database.php';

// 引入公共函数文件
require_once COMMON_ROOT . '/function.php';

// 开启错误拦截
set_error_handler("errorHandle", E_ALL);

// 加载初始化文件
require_once PUBLIC_ROOT . 'init.php';
