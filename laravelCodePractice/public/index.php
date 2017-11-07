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

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights. 我们需要照亮PHP开发，所以让我们打开灯光。
| This bootstraps the framework and gets it ready for use, then it     这引导框架，并准备好使用，然后它将加载这个应用程序
| will load up this application so that we can run it and send         以便我们可以运行它并发送回应给浏览器并使用户满意。
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__ . '/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application  运行应用
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel（核心）, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/