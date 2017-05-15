<?php
/**
 * Created by PhpStorm.
 * User: 子兴的期盼
 * Date: 2016/11/11
 * Time: 12:02
 */
define('IN_GT',true);
//定义调用css常量
define('CSS','active');
//引入文件
require dirname(__FILE__).'/includes/common.inc.php';//   转换绝对路径  访问速度较快
//初始化
//$_GET['action'] = isset($_GET['action']) ? $_GET['action'] : '';
//开始激活处理
if (!isset($_GET['active'])){
    alert_back("非法操作!");
}
if (isset($_GET['action']) && isset($_GET['active']) && $_GET['action'] == 'ok'){
    $result = mysqli_query($link,"SELECT tg_active FROM tg_user WHERE tg_active='{$_GET['active']}' LIMIT 1");
    if (mysqli_fetch_array($result,MYSQLI_ASSOC)){
    //将tg_active设置为NULL
        $query = "UPDATE tg_user SET tg_active=NULL WHERE tg_active='{$_GET['active']}' LIMIT 1";
        mysqli_query($link,$query);
        if (mysqli_affected_rows($link) == 1){
            mysqli_close($link);
            location('账户激活成功!','login.php');
        }else{
            mysqli_close($link);
            location('账户激活失败!','register.php');
        }
    }else{
        alert_back("非法操作!");
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>多用户留言系统用户激活</title>
</head>
<?php require ROOT_PATH.'includes/title.inc.php'?>
<script type="text/javascript" src="js/register.js"></script>
<body>
<!--header-->
<?php require ROOT_PATH.'includes/header.inc.php'?>

<div id="active">
    <h2>激活账户</h2>
    <p>本页面是为了模拟您的邮件功能,点击以下超级链接激活您的账户</p>
    <p><a href="active.php?action=ok&amp;&active=<?php echo $_GET['active']?>" >
            <?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']?>active.php?action=ok&amp;active=<?php echo $_GET['active']?>
        </a>
    </p>
</div>

<!--footer-->
<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>
