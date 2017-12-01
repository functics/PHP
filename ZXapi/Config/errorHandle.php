<?php

/**
 * 报错信息拦截处理
 */

set_error_handler("errorHandle");

function errorHandle($errNo, $errStr, $errFile, $errLine)
{
    switch ($errNo) {
        case E_ERROR:
            errMsg('E_ERROR', $errStr, $errFile, $errLine);
            break;
        case E_WARNING:
            errMsg('E_WARNING', $errStr, $errFile, $errLine);
            break;
        case E_PARSE:
            errMsg('E_PARSE', $errStr, $errFile, $errLine);
            break;
        case E_NOTICE:
            errMsg('E_NOTICE', $errStr, $errFile, $errLine);
            break;
        case E_CORE_ERROR:
            errMsg('E_CORE_ERROR', $errStr, $errFile, $errLine);
            break;
    }

    print(E_ALL);

    if ($errNo === E_ALL || $errNo === E_STRICT) {

    }
    return true;
}

function errMsg($msg, $errStr, $errFile, $errLine)
{
    $res = <<< EOF
"错误级别为" ： $msg;
"错误信息为" ： $errStr;
"报错文件名" ： $errFile;
"报错行数为" ： $errLine;
EOF;
}