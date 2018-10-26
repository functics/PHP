<?php

namespace Patterns\AbstractFactory;

class HtmlText extends Text
{
    public function __construct()
    {
        echo 'HtmlText' . PHP_EOL;
    }
}