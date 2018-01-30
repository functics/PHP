<?php

namespace App\kangerxin2\controller;

use App\kangerxin2\processor\OrderQuery as processor;
use App\kangerxin2\model\OrderQuery as model;

class OrderQuery
{
    public function __construct ()
    {

        // 请求api  数据$data;



        echo 'inner controller' . PHP_EOL;
//        $processor = new \App\kangerxin2\processor\OrderQuery();
        $processor = new processor();
        $processor->getWord();

        $model = new model();
        $model->getWord();
    }

    public function Push()
    {
        echo 'push' . PHP_EOL;
    }
}