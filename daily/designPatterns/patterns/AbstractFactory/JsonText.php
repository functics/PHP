<?php

namespace Patterns\AbstractFactory;

class JsonText extends Text
{
    public function __construct()
    {
        echo 'JsonText' . PHP_EOL;
    }
}