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
 * @return \Library\Core\DockingDI
 */
function DI() {
    return Library\Core\DockingDI::one();
}

/**
 * @return Library\Databases\MySQLdb | null
 */
function getLocalDb()
{
    global $g_local_db_config;
    debug('db_config', $g_local_db_config);
    if(!$g_local_db_config) {
        error("g_local_db_config is null!");
        return NULL;
    }

    $mysql = new Library\Databases\MySQLdb(
        $g_local_db_config['host'],
        $g_local_db_config['db_user'],
        $g_local_db_config['db_pwd'],
        false,
        $g_local_db_config['db_name']
    );

    if(!$mysql->connect()) {
        error("Mysql Connect Fail: {$host} {$db_user} {$db_name}");
        return NULL;
    }

    if($mysql->execute('SET NAMES UTF8') === false) {
        $mysql->close();
        error("Mysql set encodeing Fail");
        return NULL;
    }

    return $mysql;
}

/**
 * @最后执行成功的时间
 * @当前任务的rec_id
 */
function updateLastTime($cmd_time, $rec_id)
{
    //更新推送时间
    $ldb = getLocalDb();
    if(!$ldb) {
        error("get_local_db_fail!");
    }

    if(empty($cmd_time)) {
        error("update time empty");
    }

    if(empty($rec_id)) {
        error("update rec_id empty");
    }

    $sql = "UPDATE docking_command SET last_time = '$cmd_time' WHERE rec_id = " .$ldb->escape_string($rec_id);

    if(!$ldb->execute($sql)) {
        error("update time fail");
    }
}



/*
                    ____ ____ ____ ____ ____ ___     _    ____ ____ ____
                    |__/ |___ |    |  | |__/ |  \    |    |  | | __ [__
                    |  \ |___ |___ |__| |  \ |__/    |___ |__| |__] ___]
*/

// 详细的debug信息
function debug($msg, $data = null)
{
    DI()->logger->debug($msg, $data);
}

// 感兴趣的事件。像用户登录，SQL日志
function info($msg, $data = null)
{
    DI()->logger->info($msg, $data);
}

// 正常但有重大意义的事件。
function notice($msg, $data = null)
{
    DI()->logger->notice($msg, $data);
}

// 发生异常，使用了已经过时的API
function warning($msg, $data = null)
{
    DI()->logger->warning($msg, $data);
}

// 运行时发生了错误,抛异常
function error($msg, $data = null)
{
    DI()->logger->error($msg, $data);
    throw new Exception();
}

// 关键错误，像应用中的组件不可用，抛异常
function critical($msg, $data = null)
{
    DI()->logger->critical($msg, $data);
    throw new Exception();
}

// 需要立即采取措施的错误，像整个网站挂掉了，数据库不可用。抛异常
function alert($msg, $data = null)
{
    DI()->logger->alert($msg,$data);
    throw new Exception();
}

// 紧急情况？？   抛异常
function emergency($msg, $data = null)
{
    DI()->logger->emergency($msg, $data);
    throw new Exception();
}