<?php
/**
 * Created by PhpStorm.
 * User: 子兴的期盼
 * Date: 2016/11/12
 * Time: 19:31
 */
session_start();
//定义一个常量IN_GT用来授权调用includes中的文件
define('IN_GT',true);
//定义调用css常量
define('CSS','login');
//引入文件
require dirname(__FILE__).'/includes/common.inc.php';//   转换绝对路径  访问速度较快
//登录状态判断
login_state();
//初始化
$_POST['yzm'] = isset($_POST['yzm']) ? $_POST['yzm'] : "";
$_GET['action'] = isset($_GET['action']) ? $_GET['action'] : '';
$_POST['active'] = isset($_POST['active']) ? $_POST['active'] : '';
//开始处理登录状态
if ($_GET['action'] == "login"){
    //为了防止恶意注册,跨站攻击.
    if (!empty($system_set['code'])) {
        check_code($_POST['yzm'], $_SESSION['code']);
    }
    //引入验证文件
    include ROOT_PATH.'includes/login.class.php';
    $clean = array();
    $clean['username'] = check_username($_POST['username']);
    $clean['password'] = check_password($_POST['password'],6);
    $clean['time'] = $_POST['time'];
//    print_r($clean);
    //数据库验证
    $result = mysqli_query($link,"SELECT tg_username,tg_uniqid,tg_level FROM tg_user WHERE tg_username = '{$clean['username']}' AND tg_password = '{$clean['password']}' AND tg_active = '{$clean['active']}' LIMIT 1");
    if ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        //登录次数
        mysqli_query($link,"UPDATE tg_user SET tg_last_time=NOW(),tg_last_ip='{$_SERVER['REMOTE_ADDR']}',tg_login_count=tg_login_count+1 WHERE tg_username='{$row['tg_username']}'");
        switch ($clean['time']){
            case '0'://浏览器进程
                setcookie('username',$row['tg_username']);
                setcookie('uniqid',$row['tg_uniqid']);
                break;
            case '1'://一天
                setcookie('username',$row['tg_username'],time()+86400);
                setcookie('uniqid',$row['tg_uniqid'],time()+86400);
                break;
            case '2'://一周
                setcookie('username',$row['tg_username'],time()+604800);
                setcookie('uniqid',$row['tg_uniqid'],time()+604800);
                break;
            case '3'://一月
                setcookie('username',$row['tg_username'],time()+2592000);
                setcookie('uniqid',$row['tg_uniqid'],time()+2592000);
                break;
        }
        if ($row['tg_level'] == 1){
            $_SESSION['admin'] = $row['tg_username'];
        }
        mysqli_close($link);
        header('Location:index.php');
    }else{
        mysqli_close($link);
        location('用户名密码错误或者未被激活','login.php');
    }

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>多用户留言系统用户登陆</title>
</head>
<?php require ROOT_PATH.'includes/title.inc.php'?>
<script type="text/javascript" src="js/login.js"></script>
<body>
<!--header-->
<?php require ROOT_PATH.'includes/header.inc.php'?>

<div id="login">
    <h2>登陆</h2>
    <form method="post" name="login" action="login.php?action=login">
        <dl>
            <dt>用户登录</dt>
            <dd>用户名&#x3000;: <input type="text" name="username" class="text" title="用户名"/></dd>
            <dd>密&#x3000;&#x3000;码: <input type="password" name="password" class="text" title="密码"/></dd>
            <dd>保&#x3000;&#x3000;留:
                <input type="radio" name="time" title="密码保留时间" value="0" checked="checked"/>不保留
                <input type="radio" name="time" title="密码保留时间" value="1" />一天
                <input type="radio" name="time" title="密码保留时间" value="2" />一周
                <input type="radio" name="time" title="密码保留时间" value="3" />一月
            </dd>
            <?php if (!empty($system_set['code'])){?>
            <dd>验证码&#x3000;: <input type="text" name="yzm" class="text yzm" title="验证码"/><img src="code.php" id="code" alt="验证码"/></dd>
            <?php }?>
            <dd>
                <input type="submit" name="tj-bnt" id="tj-bnt" class="button" value="登录"/>
                <input type="submit" name="zc-bnt" id="zc-bnt" class="button" value="注册"/>
            </dd>
        </dl>
    </form>
</div>

<!--footer-->
<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>

