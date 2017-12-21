<?php

/**
 * 公共核心函数文件。
 */

/**
 * set_error_handle() 的回调函数
 * 目的是实现php报错拦截
 * @param $errNo
 * @param $errStr
 * @param $errFile
 * @param $errLine
 * @return string
 */
function errorHandle($errNo, $errStr, $errFile, $errLine)
{
    $errConstants = array(
        E_ERROR             => 'E_ERROR',// 不能获取
        E_WARNING           => 'E_WARNING',
        E_PARSE             => 'E_PARSE',// 不能获取
        E_NOTICE            => 'E_NOTICE',
        E_CORE_ERROR        => 'E_CORE_ERROR',// 不能获取
        E_CORE_WARNING      => 'E_CORE_WARNING',// 不能获取
        E_COMPILE_ERROR     => 'E_COMPILE_ERROR',// 不能获取
        E_COMPILE_WARNING   => 'E_COMPILE_WARNING',// 不能获取
        E_USER_ERROR        => 'E_USER_ERROR',
        E_USER_WARNING      => 'E_USER_WARNING',
        E_USER_NOTICE       => 'E_USER_NOTICE',
        E_STRICT            => 'E_STRICT',
        E_RECOVERABLE_ERROR => 'E_RECOVERABLE_ERROR',
        E_DEPRECATED        => 'E_DEPRECATED',
        E_USER_DEPRECATED   => 'E_USER_DEPRECATED'
    );

    // 文件路径处理
    $errFile = substr(strrchr($errFile, '\\'), 1);

    $res = "错误级别为:" . $errConstants[$errNo] . "。" . PHP_EOL .
           "错误信息为:" . $errStr               . "。" . PHP_EOL .
           "报错文件名:" . $errFile              . "。" . PHP_EOL .
           "报错行数为:" . $errLine              . "。" . PHP_EOL ;

    return print_r($res);
}

/**
 * 获取DI
 * 相当于PhalApi_DI::one()
 * @return \Library\Core\Docking_DI
 */
function DI() {
    return Library\Core\Docking_DI::one();
}

