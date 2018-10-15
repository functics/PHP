<?php

namespace Patterns\BuilderPattern;

use Patterns\BuilderPattern\Meal;
use Patterns\BuilderPattern\Item\VegBurger;
use Patterns\BuilderPattern\Item\Coke;
use Patterns\BuilderPattern\Item\ChickenBurger;
use Patterns\BuilderPattern\Item\Pepsi;

class MealBuilder
{
    public function prepareVegMeal()
    {
        $meal = new Meal();
        $meal->addItem(new VegBurger());
        $meal->addItem(new Coke());
        return $meal;
    }

    public function prepareNonVegMeal()
    {
        $meal = new Meal();
        $meal->addItem(new ChickenBurger());
        $meal->addItem(new Pepsi());
        return $meal;
    }
}