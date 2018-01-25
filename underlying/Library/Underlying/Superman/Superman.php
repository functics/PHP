<?php

namespace Library\Underlying\Superman;

use Library\Underlying\ModuleFactory\SuperModuleFactory;

class Superman
{
    protected $power;

    public function __construct(SuperModule $modules)
    {
        // 初始化工厂
        $factory = new SuperModuleFactory;

        // 通过工厂提供的方法制造需要的模块
        foreach ($modules as $moduleName => $moduleOptions) {
            echo $moduleName, $moduleOptions;
            echo 111;
            $this->power[] = $factory->makeModule($moduleName, $moduleOptions);
        }
    }
}





