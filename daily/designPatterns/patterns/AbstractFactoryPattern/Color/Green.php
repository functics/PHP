<?php
namespace Patterns\AbstractFactoryPattern\Color;

use Patterns\AbstractFactoryPattern\Color\Color;

class Green implements Color
{
    public function fill()
    {
        echo "Inside Green::draw() method" . PHP_EOL;
    }
}