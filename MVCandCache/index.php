<?php
include dirname(__FILE__).'/init.php';
//声明变量
$name = '何佳宁';
$content = '正在看缓存和MVC';
$array = array(1,2,3,4,5,6,7);
$tpl->assign('name', $name);
$tpl->assign('content', $content);
$tpl->assign('a', 5<4);
$tpl->assign('array',$array);
//载入tpl模版
$tpl->display('index.tpl');