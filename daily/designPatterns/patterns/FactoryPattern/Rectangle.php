<?php
namespace Patterns\FactoryPattern;

class Rectangle implements Shape
{
    public function draw() {
        echo "Inside Reactangle::draw() method" . PHP_EOL;
    }
}