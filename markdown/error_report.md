#PHP error_reporting() 错误控制函数功能详解
---
定义和用法：
error_reporting() 设置 PHP 的报错级别并返回当前级别。
 
函数语法：
error_reporting(report_level)
 
如果参数 level 未指定，当前报错级别将被返回。下面几项是 level 可能的值：
值 常量 描述
1 E_ERROR 致命的运行错误。错误无法恢复，暂停执行脚本。
2 E_WARNING 运行时警告(非致命性错误)。非致命的运行错误，脚本执行不会停止。
4 E_PARSE 编译时解析错误。解析错误只由分析器产生。
8 E_NOTICE 运行时提醒(这些经常是你代码中的bug引起的，也可能是有意的行为造成的。)
16 E_CORE_ERROR PHP启动时初始化过程中的致命错误。
32 E_CORE_WARNING PHP启动时初始化过程中的警告(非致命性错)。
64 E_COMPILE_ERROR 编译时致命性错。这就像由Zend脚本引擎生成了一个E_ERROR。
128 E_COMPILE_WARNING 编译时警告(非致命性错)。这就像由Zend脚本引擎生成了一个E_WARNING警告。
256 E_USER_ERROR 用户自定义的错误消息。这就像由使用PHP函数trigger_error（程序员设置E_ERROR）
512 E_USER_WARNING 用户自定义的警告消息。这就像由使用PHP函数trigger_error（程序员设定的一个E_WARNING警告）
1024 E_USER_NOTICE 用户自定义的提醒消息。这就像一个由使用PHP函数trigger_error（程序员一个E_NOTICE集）
2048 E_STRICT 编码标准化警告。允许PHP建议如何修改代码以确保最佳的互操作性向前兼容性。
4096 E_RECOVERABLE_ERROR 开捕致命错误。这就像一个E_ERROR，但可以通过用户定义的处理捕获（又见set_error_handler（））
8191 E_ALL 所有的错误和警告(不包括 E_STRICT) (E_STRICT will be part of E_ALL as of PHP 6.0)
 

例子：
任意数目的以上选项都可以用“或”来连接(用 OR 或 |)，这样可以报告所有需要的各级别错误。
例如，下面的代码关闭了用户自定义的错误和警告，执行了某些操作，然后恢复到原始的报错级别：

```php
<?php
//禁用错误报告
error_reporting(0);
 
//报告运行时错误
error_reporting(E_ERROR | E_WARNING | E_PARSE);
 
//报告所有错误
error_reporting(E_ALL);

```

```php
 1     Fatal Error:致命错误（脚本终止运行）
 2         E_ERROR         // 致命的运行错误，错误无法恢复，暂停执行脚本
 3         E_CORE_ERROR    // PHP启动时初始化过程中的致命错误
 4         E_COMPILE_ERROR // 编译时致命性错，就像由Zend脚本引擎生成了一个E_ERROR
 5         E_USER_ERROR    // 自定义错误消息。像用PHP函数trigger_error（错误类型设置为：E_USER_ERROR）
 6 
 7     Parse Error：编译时解析错误，语法错误（脚本终止运行）
 8         E_PARSE  //编译时的语法解析错误
 9 
10     Warning Error：警告错误（仅给出提示信息，脚本不终止运行）
11         E_WARNING         // 运行时警告 (非致命错误)。
12         E_CORE_WARNING    // PHP初始化启动过程中发生的警告 (非致命错误) 。
13         E_COMPILE_WARNING // 编译警告
14         E_USER_WARNING    // 用户产生的警告信息
15 
16     Notice Error：通知错误（仅给出通知信息，脚本不终止运行）
17         E_NOTICE      // 运行时通知。表示脚本遇到可能会表现为错误的情况.
18         E_USER_NOTICE // 用户产生的通知信息。
```