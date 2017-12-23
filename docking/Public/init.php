<?php

// 开启错误拦截
set_error_handler("errorHandle", E_ALL);

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

// 加载核心框架
DI()->docking = new \Library\Core\Docking();
