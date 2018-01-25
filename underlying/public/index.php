<?php

require '../vendor/autoload.php';

use Library\Underlying\Ability AS Ability;
use Library\Underlying\Superman AS Superman;
use Library\Underlying\Container AS Container;

// 超能力模组
$superModule = new Ability\XPower;
// 初始化一个超人，并注入一个超能力模组依赖
$superMan = new Superman\Superman($superModule);

// 创建一个容器（后面称作超级工厂）
$container = new Container\Container;

// 向该 超级工厂添加超人的生产脚本
$container->bind('superman', function($container, $moduleName) {
    return new Superman\Superman($container->make($moduleName));
});

// 向该 超级工厂添加超能力模组的生产脚本
$container->bind('xpower', function($container) {
    return new Ability\XPower;
});

// 同上
$container->bind('ultrabomb', function($container) {
    return new Ability\UltraBomb;
});

// ****************** 华丽丽的分割线 **********************
// 开始启动生产
$superman_1 = $container->make('superman', 'xpower');
$superman_2 = $container->make('superman', 'ultrabomb');
$superman_3 = $container->make('superman', 'xpower');
// ...随意添加