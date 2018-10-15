<?php

namespace Patterns\BuilderPattern\Item;

use Patterns\BuilderPattern\Item\Item;
use Patterns\BuilderPattern\Packing\Bottle;

abstract class ColdDrink implements Item
{
    public function packing()
    {
        return new Bottle();
    }

    abstract public function price();
}