<?php
namespace Patterns\AbstractFactoryPattern\Shape;

use Patterns\AbstractFactoryPattern\Shape\Shape;

class Rectangle implements Shape
{
    public function draw()
    {
        echo "Inside Rectangle::draw() method" . PHP_EOL;
    }
}