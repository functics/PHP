<?php
namespace Patterns\FactoryPattern;

class Circle implements Shape
{
    public function draw()
    {
        echo "inside Circle::draw() method" . PHP_EOL;
    }
}