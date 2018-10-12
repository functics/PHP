<?php

namespace Patterns\BuilderPattern;

interface Item
{
    public function name();

    public function packing();

    public function price();
}