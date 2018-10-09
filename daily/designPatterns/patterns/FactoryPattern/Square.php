<?php
namespace Patterns\FactoryPattern;

class Square implements Shape
{
    public function draw()
    {
        echo "inside Square::draw() method" . PHP_EOL;
    }
}