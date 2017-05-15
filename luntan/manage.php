<?php
/**
 * Created by PhpStorm.
 * User: 子兴的期盼
 * Date: 2016/11/17
 * Time: 14:27
 */
session_start();
//定义一个常量IN_GT用来授权调用includes中的文件
define('IN_GT',true);
//定义调用css常量
define('CSS','manage');
//引入文件
require dirname(__FILE__).'/includes/common.inc.php';//   转换绝对路径  访问速度较快
//必须是管理员才能登录
if ((!isset($_SESSION['admin'])) || (!isset($_COOKIE['username']))){
    alert_back("非法操作!");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>多用户留言系统后台管理中心</title>
    <?php require ROOT_PATH.'includes/title.inc.php'?>
</head>

<body>
<?php require ROOT_PATH.'includes/header.inc.php'?>

<div id="member">
    <div id="member_sidebar">
        <h2>管理导航</h2>
        <dl>
            <dt>系统管理</dt>
            <dd><a href="manage.php" >后台设置</a></dd>
            <dd><a href="manage_set.php" >系统设置</a></dd>
        </dl>
        <dl>
            <dt>会员管理</dt>
            <dd><a href="manage_member.php" >会员列表</a></dd>
            <dd><a href="manage_job.php" >职务设置</a></dd>
        </dl>
    </div>

    <div id="member_main">
        <h2>后台管理中心</h2>
        <dl>
            <dd>服务器主机名:<?php echo $_SERVER['SERVER_NAME'];?></dd>
            <dd>服务器版本:<?php echo getenv('OS');?></dd>
            <dd>通信协议名称/版本:<?php echo $_SERVER['SERVER_PROTOCOL'];?></dd>
            <dd>服务器IP:<?php echo $_SERVER['SERVER_ADDR'];?></dd>
            <dd>客户端IP:<?php echo $_SERVER['REMOTE_ADDR'];?></dd>
            <dd>服务器端口:<?php echo $_SERVER['SERVER_PORT'];?></dd>
            <dd>客户端端口:<?php echo $_SERVER['REMOTE_PORT'];?></dd>
            <dd>管理员邮箱:<?php echo $_SERVER['SERVER_ADMIN'];?></dd>
            <dd>Host头部的内容:<?= $_SERVER['HTTP_HOST']?></dd>
            <dd>服务器主目录:<?php echo $_SERVER['DOCUMENT_ROOT'];?></dd>
            <dd>服务器系统盘:<?php echo getenv('SystemRoot');?></dd>
            <dd>脚本执行的绝对路径:<?php echo $_SERVER['SCRIPT_FILENAME'];?></dd>
            <dd>Apache及PHP版本:<?php echo $_SERVER['SERVER_SOFTWARE'];?></dd>
        </dl>
    </div>
</div>

<!--footer-->
<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>
