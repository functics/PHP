<?php
/**
 * Created by PhpStorm.
 * User: 子兴的期盼
 * Date: 2016/11/13
 * Time: 18:15
 */
session_start();
//定义一个常量IN_GT用来授权调用includes中的文件
define('IN_GT',true);
//引入文件
require dirname(__FILE__).'/includes/common.inc.php';//   转换绝对路径  访问速度较快
//退出
setcookie("username","",time()-1);
setcookie("uniqid","",time()-1);
session_destroy();
header('Location:index.php');
?>