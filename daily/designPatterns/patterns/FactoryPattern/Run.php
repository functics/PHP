<?php
namespace Patterns\FactoryPattern;

use Patterns\FactoryPattern\ShapeFactory;

class Run
{
    public static function index()
    {
        // 实例化工厂类
        $shapeFactory = new ShapeFactory();

        //获取 Circle 的对象，并调用它的 draw 方法
        $circle = $shapeFactory->getShape('circle');
        $circle->draw();

        //获取 Square 的对象，并调用它的 draw 方法
        $circle = $shapeFactory->getShape('square');
        $circle->draw();

        //获取 Rectangle 的对象，并调用它的 draw 方法
        $circle = $shapeFactory->getShape('rectangle');
        $circle->draw();
    }
}