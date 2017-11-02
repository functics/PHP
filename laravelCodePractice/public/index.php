<?php

/**
 * Laravel - Web艺术家的PHP框架
 *
 * @package  Laravel
 *
 * @For what :  just for practice
 *
 */

define('LARAVEL_START', microtime(true));  //当前 Unix 时间戳和微秒数 (1509610724.3548)

/*
|--------------------------------------------------------------------------
| 注册自动加载
|--------------------------------------------------------------------------
|
| Composer为我们的应用程序提供了一个方便的，自动生成的类加载器。
| 我们只需要利用它!
| 我们只需要在这里编写脚本，这样我们就不用担心稍后手动加载任何类。
| 放松感觉很好!
|
*/

require __DIR__.'/../vendor/autoload.php';  //  __DIR__ 当前目录  D:\phpStudy\WWW\PHP\laravelCodePractice
