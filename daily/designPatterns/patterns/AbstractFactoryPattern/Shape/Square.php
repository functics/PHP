<?php
namespace Patterns\AbstractFactoryPattern\Shape;

use Patterns\AbstractFactoryPattern\Shape\Shape;

class Square implements Shape
{
    public function draw()
    {
        echo "Inside Square::draw() method" . PHP_EOL;
    }
}