<?php

namespace Patterns\BuilderPattern\Item;

use Patterns\BuilderPattern\Item\Item;
use Patterns\BuilderPattern\Packing\Bottle;

abstract class ColdDrink implements Item
{
    public function pack()
    {
        return new Bottle();
    }

    public abstract function price();
}