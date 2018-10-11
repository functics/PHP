<?php

namespace Patterns\SingletonPattern;

use Patterns\SingletonPattern\Singleton;

class Run
{
    public function index()
    {
        // 直接实例化会报错
        // $singleton = new Singleton();

        // 正确调用使用getInstance实例
        $singleton = Singleton::getInstance();
        $singleton->showMessage();
    }
}