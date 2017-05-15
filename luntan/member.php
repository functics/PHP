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
define('CSS','member');
//引入文件
require dirname(__FILE__).'/includes/common.inc.php';//   转换绝对路径  访问速度较快
//是否正常登陆
if (isset($_COOKIE['username'])){
    //获取数据
    $result = mysqli_query($link,"SELECT tg_username,tg_sex,tg_face,tg_level,tg_email,tg_url,tg_qq,tg_reg_time,tg_last_time,tg_last_ip
 FROM tg_user WHERE tg_username='{$_COOKIE['username']}' LIMIT 1");
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    if ($row){
        foreach ($row as $key => $value){
            $row[$key] = htmlspecialchars($value);
        }
        mysqli_free_result($result);
    }else{
        alert_back('此用户不存在!');
    }
}else{
    alert_back('非法登陆!');
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>多用户留言系统会员中心</title>
    <?php require ROOT_PATH.'includes/title.inc.php'?>
</head>

<body>
<?php require ROOT_PATH.'includes/header.inc.php'?>

<div id="member">
    <div id="member_sidebar">
        <h2>中心导航</h2>
        <dl>
            <dt>账号管理</dt>
            <dd><a href="member.php" >个人信息</a></dd>
            <dd><a href="member_modify.php" >修改资料</a></dd>
        </dl>
        <dl>
            <dt>其他管理</dt>
            <dd><a href="member_message.php" >短信查阅</a></dd>
            <dd><a href="member_friend.php" >好友设置</a></dd>
            <dd><a href="member_flower.php" >查询花朵</a></dd>
            <dd><a href="member_photo.php" >个人相册</a></dd>
        </dl>
    </div>

    <div id="member_main">
        <h2>会员管理中心</h2>
        <dl>
            <dd>用 &nbsp;户&nbsp; 名:<?php echo $row['tg_username'];?></dd>
            <dd>性　　别:<?php echo $row['tg_sex'];?></dd>
            <dd>头　　像:<?php echo $row['tg_face'];?></dd>
            <dd>电子邮件:<?php echo $row['tg_email'];?></dd>
            <dd>主　　页:<?php echo $row['tg_url'];?></dd>
            <dd>Q 　　 Q:<?php echo $row['tg_qq'];?></dd>
            <dd>注册时间:<?php echo $row['tg_reg_time'];?></dd>
            <dd>上次登陆:<?php echo $row['tg_last_time'];?></dd>
            <dd>身　　份:<?php if ($row['tg_level'] == '1'){echo '管理员';}else{echo '注册会员';}?></dd>
            <dd>I &nbsp;P &nbsp;地址:<?php echo $row['tg_last_ip'];?></dd>
        </dl>
    </div>
</div>

<!--footer-->
<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>
