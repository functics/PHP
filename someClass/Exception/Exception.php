<?php

// 实例化使用异常
$exception = new Exception('Danger, Will Robinson', 100);
$code      = $exception->getCode(); // 100
$message   = $exception->getMessage(); // Danger, Will Robinson

try {
    // todo: 需要捕获的异常
} catch (Exception $e) {
    throw new Exception('Something went wrong. Time for dinner');
}


/*********************************************************************************/


// 异常处理程序
set_exception_handler(function (Exception $e) {
    // 处理并记录异常
});

// 我们编写的其他代码......

// 还原成之前的异常处理程序
restore_exception_handler();


/*********************************************************************************/

