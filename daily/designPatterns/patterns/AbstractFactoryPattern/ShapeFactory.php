<?php

namespace Patterns\AbstractFactoryPattern;

use Expection;
use Patterns\AbstractFactoryPattern\Shape\Shape;
use Patterns\AbstractFactoryPattern\Shape\Rectangle;
use Patterns\AbstractFactoryPattern\Shape\Circle;
use Patterns\AbstractFactoryPattern\Shape\Square;
use Patterns\AbstractFactoryPattern\AbstractFactory;

class ShapeFactory extends AbstractFactory
{
    public function getShape(string $shape) : Shape
    {
        switch ($shape) {
            case 'rectangle':
                return new Rectangle();
                break;
            case 'circle':
                return new Circle();
                break;
            case 'square':
                return new Square();
                break;
            default:
                throw new Expection('Wrong type');
        }
    }

    public function getColor(string $color)
    {
        return null;
    }
}