<?php

namespace Patterns\AbstractFactoryPattern;

use Expection;
use Patterns\AbstractFactoryPattern\Color\Color;
use Patterns\AbstractFactoryPattern\Color\Red;
use Patterns\AbstractFactoryPattern\Color\Green;
use Patterns\AbstractFactoryPattern\Color\Blue;
use Patterns\AbstractFactoryPattern\AbstractFactory;

class ColorFactory extends AbstractFactory
{
    public function getColor(string $color) : Color
    {
        switch ($color) {
            case 'red':
                return new Red();
                break;
            case 'green':
                return new Green();
                break;
            case 'blue':
                return new Blue();
                break;
            default:
                throw new Expection('Wrong color');
        }
    }

    public function getShape(string $shape)
    {
        return null;
    }
}