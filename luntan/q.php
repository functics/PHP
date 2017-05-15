<?php
/**
 * Created by PhpStorm.
 * User: 子兴的期盼
 * Date: 2016/11/4
 * Time: 11:37
 */
session_start();
define('IN_GT',true);
//定义调用css常量
define('CSS','q');
//引入文件
require dirname(__FILE__).'/includes/common.inc.php';//   转换绝对路径  访问速度较快
//初始化
if (isset($_GET['num']) && isset($_GET['path'])){
    if (!is_dir(ROOT_PATH.$_GET['path'])){
        alert_back("非法操作q2");
    }
}else{
    alert_back('非法登陆q1!');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>多用户留言系统贴图选择</title>
</head>
<?php require ROOT_PATH.'includes/title.inc.php'?>
<script type="text/javascript" src="js/qopener.js"></script>
<body>

<div id="q">
    <h3>贴图选择</h3>
    <dl>
        <?php foreach (range(1,$_GET['num']) as $num){?>
        <dd><img src="<?php echo $_GET['path'].$num?>.png" alt="头像<?php echo $_GET['path'].$num?>.png" title="头像<?php echo $num;?>"/></dd>
        <?php }?>
    </dl>
</div>

</body>
</html>