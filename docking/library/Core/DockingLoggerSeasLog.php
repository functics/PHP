<?php
/**
 * PhalApi_Logger_SeasLog 文件日记纪录类
 * 使用SeasLog扩展
 */

namespace Library\Core;

use SeasLog;

class DockingLoggerSeasLog extends DockingLogger {

    /** 外部传参 **/
    protected $logFolder;
    protected $dateFormat;

    /** 内部状态 **/
    protected $fileDate;
    protected $logFile;

    public function __construct($logFolder, $level, $dateFormat = 'Y-m-d H:i:s')
    {
        $this->logFolder  = $logFolder;
        $this->dateFormat = $dateFormat;

        parent::__construct($level);
    }

    public function setLogger($logger)
    {
        if(is_array($logger)){
            $logger = implode(DIRECTORY_SEPARATOR, $logger);
        }
        SeasLog::setLogger($logger);
    }

    public function log($type, $msg, $data)
    {
        $msgArr = array();
        $msgArr[] = $msg;
        if ($data !== NULL) {
            $msgArr[] = is_array($data) ? json_encode($data) : print_r($data, true);
        }
        $content = implode('|', $msgArr);//seasLog写入的时候会自己加换行符所以这里就不加了 PHP_EOL
        $content = str_replace(PHP_EOL, '', $content);
        SeasLog::log($type,$content, array(),'');
    }

    public function flushBuffer()
    {
        SeasLog::flushBuffer();
    }
}