<?php

namespace Library\Underlying\ModuleFactory;

use Library\Underlying\Ability\Fight;
use Library\Underlying\Ability\Force;
use Library\Underlying\Ability\Shot;

class SuperModuleFactory
{
    public function makeModule($moduleName, $options)
    {
        switch ($moduleName) {
            case 'Fight':
                return new Fight($options[0], $options[1]);
            case 'Force':
                return new Force($options[0]);
            case 'Shot':
                return new Shot($options[0], $options[1], $options[2]);
            // case 'more': .......
            // case 'and more': .......
            // case 'and more': .......
            // case 'oh no! its too many!': .......
        }
    }
}