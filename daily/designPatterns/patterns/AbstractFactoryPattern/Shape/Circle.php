<?php
namespace Patterns\AbstractFactoryPattern\Shape;

use Patterns\AbstractFactoryPattern\Shape\Shape;

class Circle implements Shape
{
    public function draw()
    {
        echo "Inside Circle::draw() method" . PHP_EOL;
    }
}