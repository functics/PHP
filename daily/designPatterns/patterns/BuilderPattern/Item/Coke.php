<?php

namespace Patterns\BuilderPattern\Item;

use Patterns\BuilderPattern\Item\ColdDrink;

class Coke extends ColdDrink
{
    public function price() : float
    {
        return 30.0;
    }

    public function name()
    {
        return "Coke";
    }
}