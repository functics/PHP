<?php

namespace Patterns\BuilderPattern\Item;

use Patterns\BuilderPattern\Item\Burger;

class ChickenBurger extends Burger
{
    public function price() : float
    {
        return 50.5;
    }

    public function name()
    {
        return "Chicken Burger";
    }
}