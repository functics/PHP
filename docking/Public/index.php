<?php

/**
 * docking入口
 */

// 程序开始时间
define('API_START', microtime(true));

// 这里使用composer的自动加载类
require __DIR__.'/../vendor/autoload.php';

// 加载初始化文件
require PUBLIC_PATH . 'init.php';
