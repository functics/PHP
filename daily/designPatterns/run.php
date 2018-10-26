<?php

use Patterns\AbstractFactory\Test as AbstractFactoryTest; // 抽象工厂模式

// 抽象工厂模式
$abstractFactoryTest = new AbstractFactoryTest();
$abstractFactoryTest->testCanCreateHtmlText();
$abstractFactoryTest->testCanCreateJsonText();
