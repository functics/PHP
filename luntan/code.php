<?php
/**
 * Created by PhpStorm.
 * User: 子兴的期盼
 * Date: 2016/11/5
 * Time: 16:18
 */
session_start();
//定义一个常量IN_GT用来授权调用includes中的文件
define('IN_GT',true);
//引入文件
require dirname(__FILE__).'/includes/common.inc.php';//   转换绝对路径  访问速度较快
//运行验证码函数
//默认验证码长为75px,高为25px,随机码个数为4,默认不显示边框
//如果需要6为  长度推荐125        8位推荐为175
code();

?>