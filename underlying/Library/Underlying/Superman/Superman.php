<?php

namespace Library\Underlying\Superman;

use Library\Underlying\ModuleFactory\SuperModuleFactory;

class Superman
{
    protected $power;

    public function __construct(SuperModuleInterface $modules)
    {
        // 初始化工厂
        $factory = new SuperModuleFactory;

        // 通过工厂提供的方法制造需要的模块
        $this->power = $factory->makeModule('Fight', [9, 100]);
        foreach ($modules as $moduleName => $moduleOptions) {
            $this->power[] = $factory->makeModule($moduleName, $moduleOptions);
        }
    }
}





