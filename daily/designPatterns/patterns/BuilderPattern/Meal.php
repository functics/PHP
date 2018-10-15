<?php

namespace Patterns\BuilderPattern;

use Patterns\BuilderPattern\Item\Item;

class Meal
{
    private $itemArr = [];

    public function addItem(Item $item)
    {
        array_push($this->itemArr, $item);
    }

    public function getCost()
    {
        $cost = 0.0;

        foreach ($this->itemArr as $item) {
            $cost += $item->price();
        }

        return $cost;
    }

    public function showItems()
    {
        foreach ($this->itemArr as $item) {
            echo "Item : " . $item->name();
            echo ", Packing : " . $item->packing()->pack();
            echo ", Price : " . $item->price() . PHP_EOL;
        }
    }
}