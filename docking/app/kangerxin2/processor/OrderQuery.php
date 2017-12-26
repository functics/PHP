<?php

namespace App\kangerxin2\processor;

use Library\Core\DockingProcessor;
use App\kangerxin2\model\OrderQuery as model;

class OrderQuery extends DockingProcessor
{
    public function __construct ()
    {
        echo 'inner processor' . PHP_EOL;
        $model = new model();
        echo $model->getWord() . PHP_EOL;
    }

    public function getWord()
    {
        echo 'here is the processor' . PHP_EOL;
    }
}