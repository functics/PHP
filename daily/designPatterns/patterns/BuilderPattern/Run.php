<?php

namespace Patterns\BuilderPattern;

use Patterns\BuilderPattern\MealBuilder;

class Run
{
    public function index()
    {
        $mealBuilder = new MealBuilder();

        $vegMeal = $mealBuilder->prepareVegMeal();
        echo "Veg Meal" . PHP_EOL;
        $vegMeal->showItems();
        echo "Total Cost: " . $vegMeal->getCost() . PHP_EOL;

        echo PHP_EOL;

        $nonVegMeal = $mealBuilder->prepareNonVegMeal();
        echo "Non-veg Meal" . PHP_EOL;
        $nonVegMeal->showItems();
        echo "Total Cost: " . $nonVegMeal->getCost() . PHP_EOL;
    }
}