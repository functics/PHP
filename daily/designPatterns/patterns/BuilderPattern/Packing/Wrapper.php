<?php

namespace Patterns\BuilderPattern\Packing;

use Patterns\BuilderPattern\Packing\Packing;

class Wrapper implements Packing
{
    public function pack()
    {
        return "Wrapper";
    }
}