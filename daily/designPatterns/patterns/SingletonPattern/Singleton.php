<?php

namespace Patterns\SingletonPattern;

class Singleton
{
    private static $instance;

    private function __construct()
    {
        echo "new Singleton instance" . PHP_EOL;
    }

    // 私有化克隆方法
    private function __clone()
    {

    }

    // 私有化构造方法
    public static function getInstance() : Singleton
    {

        if (!(self::$instance instanceof Singleton)) {
            self::$instance = new Singleton();
        }

        return self::$instance;
    }

    public function showMessage()
    {
        echo "Hello World" . PHP_EOL;
    }
}