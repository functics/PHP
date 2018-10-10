<?php

namespace Patterns\AbstractFactoryPattern;

use Patterns\AbstractFactoryPattern\FactoryProducer;

class Run
{
    public static function index()
    {
        echo "AbstractFactory" . PHP_EOL;

        // 获取形状工厂
        $shapeFactory = FactoryProducer::getFactory('shape');
        // 获取 circle
        $circle = $shapeFactory->getShape('circle')->draw();
        // 获取 rectangle
        $circle = $shapeFactory->getShape('rectangle')->draw();
        // 获取 square
        $circle = $shapeFactory->getShape('square')->draw();

        // 获取颜色工厂
        $colorFactory = FactoryProducer::getFactory('color');
        // 获取 red
        $red = $colorFactory->getColor('red')->fill();
        // 获取 green
        $green = $colorFactory->getColor('green')->fill();
        // 获取 blue
        $blue = $colorFactory->getColor('blue')->fill();
    }
}