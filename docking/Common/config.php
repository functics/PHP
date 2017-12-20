<?php

/*
            ____ _   _ ____ ___ ____ ____ _  _    ____ ____ _  _ ____ _ ____
            [__   \_/  [__   |  |___ |__/ |\/|    |    |  | |\ | |___ | | __
            ___]   |   ___]  |  |___ |  \ |  |    |___ |__| | \| |    | |__]
 */

/*
 * 定义目录文件路径
 * 定义项目根目录，项目是通过队列执行的，所以一定要使用跟队列相同的根目录
 */
defined('COMMON_ROOT')  || define('COMMON_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
defined('DOCKING_PATH') || define('DOCKING_PATH', dirname(COMMON_ROOT) . DIRECTORY_SEPARATOR);
defined('PUBLIC_ROOT')  || define('PUBLIC_ROOT', DOCKING_PATH . 'Public' . DIRECTORY_SEPARATOR);
defined('LIBRARY_ROOT') || define('LIBRARY_ROOT', DOCKING_PATH . 'Library' . DIRECTORY_SEPARATOR);

// 日志目录
defined('G_LOG_DIR') || define('G_LOG_DIR', '/data/apache_logs/docking/api2_logs/');

// 缓存目录
defined('G_CACHE_DIR') || define('G_CACHE_DIR', '/data/apache_logs/docking/cache/');

defined('G_ESHOP_ROUTER_URL') || define('G_ESHOP_ROUTER_URL', 'http://10.173.84.149:25081/api');

// 当前机器的ip
defined('G_FRONT_HOST') || define('G_FRONT_HOST', 'api.wangdian.cn');

// 调试模式
defined('DEBUG') || define('DEBUG', 0);

/*
            ___  ____ ____ ____ _  _ ____    ____ ____ _  _ ____ _ ____
            |__] |__| |__/ |__| |\/| [__     |    |  | |\ | |___ | | __
            |    |  | |  \ |  | |  | ___]    |___ |__| | \| |    | |__]
*/

// WDT配置
defined('PAGE_SIZE')  || define('PAGE_SIZE', 10);
defined('WDT_APPKEY') || define('WDT_APPKEY', 'mytest');
defined('WDT_SECRET') || define('WDT_SECRET', '12345');