<?php

namespace Patterns\AbstractFactoryPattern;

abstract class AbstractFactory
{
    public abstract function getShape(string $shape);

    public abstract function getColor(string $color);
}