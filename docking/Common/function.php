<?php

/**
 * 公共函数文件。
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
 * 用于队列调用
 * 方法名要跟文件名一致，文件名_main的方式命名
 * @return bool
 */
function index_main()
{
    $ldb = getLocalDb();
    if(!$ldb) {
        error("get_local_db_fail!");
        return false;
    }

    $com_list = $ldb->query("select `rec_id`,`sid`,`method`,`action`,`last_time`,`wdt_config`,`oth_config` from docking_command where is_disable=0");
    while($command = $ldb->fetch_array($com_list)) {
        pushTask('command_pro',$command);
    }

    return true;
}


/**
 * @param $g_local_db_config array
 * @return MySQLdb|object
 */
function getLocalDb ($g_local_db_config)
{
    // 记录数据库配置日志
    debug('db_config', $g_local_db_config);

    if (!$g_local_db_config) {
        error("g_local_db_config is null!");
        return null;
    }

    // 实例化封装数据库
    $mysql = new MySQLdb(
        $g_local_db_config['host'],
        $g_local_db_config['db_user'],
        $g_local_db_config['db_pwd'],
        false,
        $g_local_db_config['db_name'],
        $g_local_db_config['tag']
    );

    if(!$mysql->connect()) {
        error("Mysql Connect Fail: {$host} {$db_user} {$db_name}");
        return null;
    }

    if($mysql->execute('SET NAMES UTF8') === false) {
        $mysql->close();
        error("Mysql set encodeing Fail");
        return null;
    }

    return $mysql;
}