<?php

namespace Patterns\AbstractFactoryPattern;

use Patterns\AbstractFactoryPattern\AbstractFactory;
use Patterns\AbstractFactoryPattern\ShapeFactory;
use Patterns\AbstractFactoryPattern\ColorFactory;

class FactoryProducer
{
    public static function getFactory(string $choice) : AbstractFactory
    {
        switch ($choice) {
            case 'shape':
                return new ShapeFactory();
                break;
            case 'color':
                return new ColorFactory();
                break;
            default:
                throw new Expection('Wrong choice');
        }
    }
}