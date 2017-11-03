<?php

#### 闭包可以从父作用域中继承变量。
#    任何此类变量都应该用 use 语言结构传递进去。
#    PHP 7.1 起，不能传入此类变量： superglobals、 $this 或者和参数重名。

$message = 'hello';

// 没有用 "use"
/*

$example = function ()
{
    var_dump($message);
};

echo $example();  // Undefined variable: message

*/

//继承 $message
$example = function () use ($message)
{
    var_dump($message);
};
echo $example();   // string(5) "hello"


// Inherited variable's value is from when the function is defined, not when called
// 继承变量的值是从函数定义的时候开始，而不是在调用的时候
$message = 'world';
echo $example();   // string(5) "hello"


// Inherit by-reference
$example = function () use (&$message) {
    var_dump($message);
};

$message = 'world';
echo $example();


// Closures can also accept regular arguments
$example = function ($arg) use ($message) {
    var_dump($arg . ' ' . $message);
};
$example("hello");
