<?php

namespace Patterns\BuilderPattern\Item;

interface Item
{
    public function name();

    public function packing();

    public function price();
}