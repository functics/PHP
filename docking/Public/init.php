<?php

// 开启错误拦截
set_error_handler("errorHandle", E_ALL);

// 注册日志类
DI()->logger = new Library\Core\DockingLoggerSeasLog(
    DOCKING_PATH . '/Runtime',
    Library\Core\DockingLogger::LOG_LEVEL_DEBUG |
    Library\Core\DockingLogger::LOG_LEVEL_INFO |
    Library\Core\DockingLogger::LOG_LEVEL_NOTICE |
    Library\Core\DockingLogger::LOG_LEVEL_WARNING |
    Library\Core\DockingLogger::LOG_LEVEL_ERROR |
    Library\Core\DockingLogger::LOG_LEVEL_CRITICAL |
    Library\Core\DockingLogger::LOG_LEVEL_ALERT |
    Library\Core\DockingLogger::LOG_LEVEL_EMERGENCY
);

// 加载核心框架
DI()->docking = new \Library\Core\Docking();

$item = array(
    'rec_id'     => 7,
    'sid'        => 'kangerxin2',
    'method'     => 'OrderQuery',
    'action'     => 'Push',
    'wdt_config' => array(
        'sid'       => 'kangerxin2',
        'appkey'    => 'docking',
        'appsecret' => 'fb19a7198b20fa67ee463e56d75522ef'
    ),
    'last_time'  => '2017-08-05 10:32:03',
    'is_disable' => 0,
    'is_check'   => 1,
    'step'       => 0,
);

//$item = (object)$item;

DI()->docking->run($item);

echo '走完了';

