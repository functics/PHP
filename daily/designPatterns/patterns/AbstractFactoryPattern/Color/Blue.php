<?php
namespace Patterns\AbstractFactoryPattern\Color;

use Patterns\AbstractFactoryPattern\Color\Color;

class Blue implements Color
{
    public function fill()
    {
        echo "Inside Blue::draw() method" . PHP_EOL;
    }
}