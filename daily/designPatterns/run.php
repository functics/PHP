<?php

use Patterns\FactoryPattern\Run as FactoryRun;                 // 工厂模式
use Patterns\AbstractFactoryPattern\Run as AbstractFactoryRun; // 抽象工厂模式

// 工厂模式
// $factoryRun = new FactoryRun();
// $factoryRun::index();

// 抽象工厂模式
$abstractFactoryRun = new AbstractFactoryRun();
$abstractFactoryRun::index();
