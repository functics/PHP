<?php
/**
 * 框架的核心类文件
 */

namespace Library\Core;

class Docking
{
    private $item;

    public function run($item)
    {
        try{
            $this->item = $item;

            // 设置执行时间
            $this->item->cmd_time = date('Y-m-d H:i:s', time());
            // 设置步长,即每次查询多长时间的数据，设置好的间隔分钟数换算成秒
            $step = $this->item->step * 60;

            $cmd = strtotime($this->item->cmd_time);
            $last = strtotime($this->item->last_time);
            //获取当前的时间差秒数
            $cur_step = $cmd-$last;

            //判断推送周期，如果当前时间段非周期内时间则直接返回
            if ($step > $cur_step) {
                return true;
            } else {
                if ($step == 0) {
                    $this->item->cmd_time = date('Y-m-d H:i:s', time());
                } else {
                    $this->item->cmd_time = date('Y-m-d H:i:s', $last+$step);
                }
            }

            /**
             * Beanstalk传递过来的参数是一个对象所以这里就按对象使用
             * 其他项目可以根据需要修改
             */
            if (!is_object($this->item)) {
                error('Invalid_Item_Config');
            }

            if (empty($this->item->sid)) {
                error('Invalid_Sid');
            }

            $sid = $this->item->sid;

            /**
             * 加载项目目录,如果需要新增其他目录请在此处修改
             *
             */
            DI()->loader->addDirs(array('app/'.$sid));
            $method = @$this->item->method;

            if (!class_exists($method)) {
                error('Invalid_Method');
            }

            //创建类
            $worker = new $method($this->item);
            /*if (!is_subclass_of($worker,'Docking_Interface')) {
                throw new Exception("没有正确继承");
            }*/

            //检查方法
            $action = @$this->item->action;
            if (!method_exists($worker, $action)) {
                error('Invalid_Action');
            }

            //设置日志目录
            DI()->logger->setLogger(array($sid,$method,$action));

            debug("dirs:",DI()->loader->getDirs());
            debug("===START===");
            debug(print_r($item,true));
            //执行
            $worker->$action();

            updateLastTime(@$this->item->cmd_time,@$this->item->rec_id); // 处理成功，更新最后处理时间;
            debug("===END===");

            //把缓存中的日志刷到硬盘
            DI()->logger->flushBuffer();

            return true;

        }catch (\Exception $e) {
            //把缓存中的日志刷到硬盘
            debug("===ERROR===");
            DI()->logger->flushBuffer();
            return false;
        }
    }
}