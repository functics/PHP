<?php

namespace Patterns\BuilderPattern\Item;

use Patterns\BuilderPattern\Item\Item;
use Patterns\BuilderPattern\Packing\Wrapper;

abstract class Burger implements Item
{
    public function packing()
    {
        return new Wrapper();
    }

    public abstract function price();
}