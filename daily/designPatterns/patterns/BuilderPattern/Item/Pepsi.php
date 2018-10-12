<?php

namespace Patterns\BuilderPattern\Item;

use Patterns\BuilderPattern\Item\ColdDrink;

class Pepsi extends ColdDrink
{
    public function price() : float
    {
        return 35.0;
    }

    public function name()
    {
        return "Pepsi";
    }
}