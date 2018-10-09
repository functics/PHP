<?php
namespace Patterns\FactoryPattern;

use Expection;
use Patterns\FactoryPattern\Shape;
use Patterns\FactoryPattern\Rectangle;
use Patterns\FactoryPattern\Circle;
use Patterns\FactoryPattern\Square;

class ShapeFactory
{
    public function getShape(string $type) : Shape
    {
        switch ($type) {
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
}