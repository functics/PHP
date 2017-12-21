<?php

// 这里使用composer的自动加载类
require_once VENDOR_ROOT . 'autoload.php';

// 引入公共函数文件
require_once CONFIG_ROOT . '/function.php';

// 开启错误拦截
set_error_handler("errorHandle", E_ALL);

// 数据库读取
$g_local_db_config = require CONFIG_ROOT . 'database.php';

// 加载核心目录
$loader = new Library\Core\Docking();

// 注册自动加载器
DI()->loader = $loader;

// 注册日志类
DI()->logger = new Library\Core\Docking_Logger_SeasLog(
    DOCKING_PATH . '/Runtime',
    Library\Core\Docking_Logger::LOG_LEVEL_DEBUG |
    Library\Core\Docking_Logger::LOG_LEVEL_INFO |
    Library\Core\Docking_Logger::LOG_LEVEL_NOTICE |
    Library\Core\Docking_Logger::LOG_LEVEL_WARNING |
    Library\Core\Docking_Logger::LOG_LEVEL_ERROR |
    Library\Core\Docking_Logger::LOG_LEVEL_CRITICAL |
    Library\Core\Docking_Logger::LOG_LEVEL_ALERT |
    Library\Core\Docking_Logger::LOG_LEVEL_EMERGENCY
);

