<?php

/**
 * 报错信息拦截处理
 */

set_error_handler("errorHandle", E_ALL);

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

    $res = "错误级别为:" . $errConstants[$errNo] . "。" . BR .
           "错误信息为:" . $errStr               . "。" . BR .
           "报错文件名:" . $errFile              . "。" . BR .
           "报错行数为:" . $errLine              . "。" . BR ;

    return print_r($res);
}