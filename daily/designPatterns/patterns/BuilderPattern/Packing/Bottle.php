<?php

namespace Patterns\BuilderPattern\Packing;

use Patterns\BuilderPattern\Packing\Packing;

class Bottle implements Packing
{
    public function pack()
    {
        return "Bottle";
    }
}