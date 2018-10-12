<?php

namespace Patterns\BuilderPattern\Item;

use Patterns\BuilderPattern\Item\Burger;

class VegBurger extends Burger
{
    public function price() : float
    {
        return 25.0;
    }

    public function name()
    {
        return "Veg Burger";
    }
}