<?php
namespace Patterns\AbstractFactoryPattern\Color;

use Patterns\AbstractFactoryPattern\Color\Color;

class Red implements Color
{
    public function fill()
    {
        echo "Inside Red::draw() method" . PHP_EOL;
    }
}