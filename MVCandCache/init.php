<?php
//设置编码格式为utf-8
header('Content-Type : text/html;charset=uft-8 ');
//设置网站根目录
define('ROOT_PATH', dirname(__FILE__));
//设置模版文件路径
define('TPL_DIR', ROOT_PATH.'/templates/');
//设置编译文件
define('TPL_C_DIR', ROOT_PATH.'/templates_c/');
//缓存文件目录
define('CACHE', ROOT_PATH.'/cache/');
//是否开启缓冲区
define('DEBUG',true);
DEBUG ? ob_start() : null;
//引入类文件
require ROOT_PATH.'/includes/Templates.class.php';
//实例化模版类
$tpl = new Templates();