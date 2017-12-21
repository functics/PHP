<?php
/**
 * PhalApi_Logger 日记抽象类
 *
 * - 对系统的各种情况进行纪录，具体存储媒介由实现类定义
 * - 日志分类型，不分优先级，多种类型可按并组合
 *
 * <br>接口实现示例：<br>
```
 *      class PhalApi_Logger_Mock extends PhalApi_Logger {
 *          public function log($type, $msg, $data) {
 *              //nothing to do here ...
 *          }
 *      }
 *
 *      //保存全部类型的日记
 *      $logger = new PhalApi_Logger_Mock(
 *          PhalApi_Logger::LOG_LEVEL_DEBUG | PhalApi_Logger::LOG_LEVEL_INFO | PhalApi_Logger::LOG_LEVEL_ERROR);
 *
 *      //开发调试使用，且带更多信息
 *      $logger->debug('this is bebug test', array('name' => 'mock', 'ver' => '1.0.0'));
 *
 *      //业务场景使用
 *      $logger->info('this is info test', 'and more detail here ...');
 *
 *      //一些不该发生的事情
 *      $logger->error('this is error test');
```
 *
 * @package PhalApi\Logger
 * @link http://www.php-fig.org/psr/psr-3/ Logger Interface
 * @license http://www.phalapi.net/license GPL
 * @link http://www.phalapi.net/
 * @author dogstar <chanzonghuang@gmail.com> 2014-10-02
 *
 * 8个日志级别 严重程度从上到下
 * SEASLOG_DEBUG "debug" 调试 仅限研发人员查看，生产环境默认不开启
 * SEASLOG_INFO "info" 信息 常规信息
 * SEASLOG_NOTICE "notice" 注意 不会通知用户
 * SEASLOG_WARNING "warning" 警告 每天邮件通知
 * SEASLOG_ERROR "error" 错误 立即通知用户
 *
 * 服务端错误日志,仅供研发分析查看
 * SEASLOG_CRITICAL "critical" 危险 不会发送邮件通知
 * SEASLOG_ALERT "alert" 警惕 每天邮件通知
 * SEASLOG_EMERGENCY "emergency" 紧急 立即通知
 */

namespace Library\Core;


abstract class Docking_Logger {

    /**
     * @var int $logLevel 多个日记级别
     */
    protected $logLevel = 0;

    /**
     * @var int LOG_LEVEL_DEBUG 调试级别
     */
    const LOG_LEVEL_DEBUG = 1;

    /**
     * @var int LOG_LEVEL_INFO 产品级别
     */
    const LOG_LEVEL_INFO = 2;

    /**
     * @var int LOG_LEVEL_NOTICE 注意级别
     */
    const LOG_LEVEL_NOTICE = 4;

    /**
     * @var int LOG_LEVEL_WARNING 警告级别
     */
    const LOG_LEVEL_WARNING = 8;

    /**
     * @var int LOG_LEVEL_ERROR 错误级别
     */
    const LOG_LEVEL_ERROR = 16;

    /**
     * @var int LOG_LEVEL_CRITICAL 危险级别
     */
    const LOG_LEVEL_CRITICAL = 32;

    /**
     * @var int LOG_LEVEL_ALERT 警惕级别
     */
    const LOG_LEVEL_ALERT = 64;

    /**
     * @var int LOG_LEVEL_EMERGENCY 紧急级别
     */
    const LOG_LEVEL_EMERGENCY = 128;

    public function __construct($level) {
        $this->logLevel = $level;
    }

    /**
     * 日记纪录
     *
     * 可根据不同需要，将日记写入不同的媒介
     *
     * @param string $type 日记类型，如：info/debug/error, etc
     * @param string $msg 日记关键描述
     * @param string/array $data 场景上下文信息
     * @return NULL
     */
    abstract public function log($type, $msg, $data);
    /**
     * 设置记录日志的路径
     * @param string $logger 主目录下日志的分层目录
     * @return NULL
     */
    abstract public function setLogger($logger);

    /**
     * 应用调试级日记
     * @param string $msg 日记关键描述
     * @param string/array $data 场景上下文信息
     * @return NULL
     */
    public function debug($msg, $data = NULL) {
        if (!$this->isAllowToLog(self::LOG_LEVEL_DEBUG)) {
            return;
        }

        $this->log('debug', $msg, $data);
    }

    /**
     * 开发产品级日记
     * @param string $msg 日记关键描述
     * @param string/array $data 场景上下文信息
     * @return NULL
     */
    public function info($msg, $data = NULL) {
        if (!$this->isAllowToLog(self::LOG_LEVEL_INFO)) {
            return;
        }

        $this->log('info', $msg, $data);
    }

    /**
     * 需要注意级日记
     * @param string $msg 日记关键描述
     * @param string/array $data 场景上下文信息
     * @return NULL
     */
    public function notice($msg, $data = NULL) {
        if (!$this->isAllowToLog(self::LOG_LEVEL_NOTICE)) {
            return;
        }

        $this->log('notice', $msg, $data);
    }

    /**
     * 警告级别日志
     * @param string $msg 日记关键描述
     * @param string/array $data 场景上下文信息
     * @return NULL
     */
    public function warning($msg, $data = NULL) {
        if (!$this->isAllowToLog(self::LOG_LEVEL_WARNING)) {
            return;
        }

        $this->log('warning', $msg, $data);
    }

    /**
     * 系统错误级日记
     * @param string $msg 日记关键描述
     * @param string/array $data 场景上下文信息
     * @return NULL
     */
    public function error($msg, $data = NULL) {
        if (!$this->isAllowToLog(self::LOG_LEVEL_ERROR)) {
            return;
        }

        $this->log('error', $msg, $data);
    }

    /**
     * 危险级日记
     * @param string $msg 日记关键描述
     * @param string/array $data 场景上下文信息
     * @return NULL
     */
    public function critical($msg, $data = NULL) {
        if (!$this->isAllowToLog(self::LOG_LEVEL_CRITICAL)) {
            return;
        }

        $this->log('critical', $msg, $data);
    }

    /**
     * 警惕级日记
     * @param string $msg 日记关键描述
     * @param string/array $data 场景上下文信息
     * @return NULL
     */
    public function alert($msg, $data = NULL) {
        if (!$this->isAllowToLog(self::LOG_LEVEL_ALERT)) {
            return;
        }

        $this->log('alert', $msg, $data);
    }

    /**
     * 紧急情况
     * @param string $msg 日记关键描述
     * @param string/array $data 场景上下文信息
     * @return NULL
     */
    public function emergency($msg, $data = NULL) {
        if (!$this->isAllowToLog(self::LOG_LEVEL_EMERGENCY)) {
            return;
        }

        $this->log('emergency', $msg, $data);
    }

    /**
     * 是否允许写入日记，或运算
     * @param int $logLevel
     * @return boolean
     */
    protected function isAllowToLog($logLevel) {
        return (($this->logLevel & $logLevel) != 0) ? TRUE : FALSE;
    }
}