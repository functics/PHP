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
define('CSS','manage_set');
//引入文件
require dirname(__FILE__).'/includes/common.inc.php';//   转换绝对路径  访问速度较快
//必须是管理员才能登录
if ((!isset($_SESSION['admin'])) || (!isset($_COOKIE['username']))){
    alert_back("非法操作1!");
}
//修改系统表
if(@$_GET['action'] == 'set'){
    $query = "SELECT tg_uniqid FROM tg_user WHERE tg_username = '{$_COOKIE['username']}'";
    $result = mysqli_query($link,$query);
    $row_set = mysqli_fetch_assoc($result);
    if ($row_set['tg_uniqid'] == $_COOKIE['uniqid']){
        $sysset = array();
        $sysset['webname'] = $_POST['webname'];
        $sysset['article'] = $_POST['article'];
        $sysset['blog'] = $_POST['blog'];
        $sysset['photo'] = $_POST['photo'];
        $sysset['skin'] = $_POST['skin'];
        $sysset['string'] = $_POST['string'];
        $sysset['post'] = $_POST['post'];
        $sysset['code'] = $_POST['code'];
        $sysset['register'] = $_POST['register'];
        //写入数据库
        $query = "UPDATE tg_system SET 
                                      tg_webname = '{$sysset['webname']}',
                                      tg_article = '{$sysset['article']}',
                                      tg_blog = '{$sysset['blog']}',
                                      tg_photo = '{$sysset['photo']}',
                                      tg_skin = '{$sysset['skin']}',
                                      tg_string = '{$sysset['string']}',
                                      tg_post = '{$sysset['post']}',
                                      tg_code = '{$sysset['code']}',
                                      tg_register = '{$sysset['register']}'
                                  WHERE
                                      tg_id=1";
        $result_set = mysqli_query($link,$query);
        if (mysqli_affected_rows($link) == 1){
            mysqli_close($link);
            location("修改成功","manage_set.php");
        }else{
            mysqli_close($link);
            location("修改失败","manage_set.php");
        }
    }else{
        alert_back("非法操作2");
    }
}
//读取系统表
$query = "SELECT * FROM tg_system WHERE tg_id = 1";
$result = mysqli_query($link,$query);
$row = mysqli_fetch_assoc($result);
if ($row){
    $sys = array();
    $sys['webname'] = $row['tg_webname'];
    $sys['article'] = $row['tg_article'];
    $sys['blog'] = $row['tg_blog'];
    $sys['photo'] = $row['tg_photo'];
    $sys['skin'] = $row['tg_skin'];
    $sys['string'] = $row['tg_string'];
    $sys['post'] = $row['tg_post'];
    $sys['code'] = $row['tg_code'];
    $sys['register'] = $row['tg_register'];
    //文章分页条数
    if ($sys['article'] == 2){
        $sys['article_blow'] = '<select name="article"><option value="2" selected="selected">每页显示两篇</option><option value="3">每页显示三篇</option></select>';
    }elseif($sys['article'] == 3){
        $sys['article_blow'] = '<select name="article"><option value="2" >每页显示两篇</option><option value="3" selected="selected">每页显示三篇</option></select>';
    }
    //博友分页条数
    if ($sys['blog'] == 4){
        $sys['blog_blow'] = '<select name="blog"><option value="4" selected="selected">每页显示四个</option><option value="8">每页显示八个</option></select>';
    }elseif($sys['blog'] = 8){
        $sys['blog_blow'] = '<select name="blog"><option value="4" >每页显示四个</option><option value="8" selected="selected">每页显示八个</option></select>';
    }
    //相册分页条数
    if ($sys['photo'] == 4){
        $sys['photo_blow'] = '<select name="photo"><option value="4" selected="selected">每页显示四张</option><option value="8">每页显示八张</option></select>';
    }elseif($sys['photo'] == 8){
        $sys['photo_blow'] = '<select name="photo"><option value="4" >每页显示四张</option><option value="8" selected="selected">每页显示八张</option></select>';
    }
    //网站皮肤
    if ($sys['skin'] == 1){
        $sys['skin_blow'] = '<select name="skin"><option value="1" selected="selected">第一款</option><option value="2">第二款</option><option value="3">第三款</option></select>';
    }elseif($sys['skin'] == 2){
        $sys['skin_blow'] = '<select name="skin"><option value="1" >第一款</option><option value="2" selected="selected">第二款</option><option value="3">第三款</option></select>';
    }elseif ($sys['skin'] == 3){
        $sys['skin_blow'] = '<select name="skin"><option value="1" >第一款</option><option value="2">第二款</option><option value="3" selected="selected">第三款</option></select>';
    }
    //发帖时间间隔
    if ($sys['post'] == 30){
        $sys['post_blow'] ='<input type="radio" name="post" value="30" checked="checked"/>30秒<input type="radio" name="post" value="60" />一分钟<input type="radio" name="post" value="180" />3分钟';
    }elseif($sys['post'] == 60){
        $sys['post_blow'] ='<input type="radio" name="post" value="30" />30秒<input type="radio" name="post" value="60" checked="checked" />一分钟<input type="radio" name="post" value="180" />3分钟';
    }elseif($sys['post'] == 180){
        $sys['post_blow'] ='<input type="radio" name="post" value="30" />30秒<input type="radio" name="post" value="60" />一分钟<input type="radio" name="post" value="180" checked="checked" />3分钟';
    }
    //起用验证码
    if ($sys['code'] == 1){
        $sys['code_blow'] = '<input type="radio" name="code" value="1" checked="checked" />启用<input type="radio" name="code" value="0" />禁用';
    }else{
        $sys['code_blow'] = '<input type="radio" name="code" value="1" />启用<input type="radio" name="code" value="0" checked="checked" />禁用';
    }
    //是否开放注册
    if ($sys['register'] == 1){
        $sys['register_blow'] = '<input type="radio" name="register" value="1" checked="checked" />启用<input type="radio" name="register" value="0" />禁用';
    }else{
        $sys['register_blow'] = '<input type="radio" name="register" value="1" />启用<input type="radio" name="register" value="0" checked="checked" />禁用';
    }
}else{
    alert_back("系统表读取错误!");
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
            <dd><a href="member.php" >后台设置</a></dd>
            <dd><a href="member_modify.php" >系统设置</a></dd>
        </dl>
        <dl>
            <dt>会员管理</dt>
            <dd><a href="manage_member.php" >会员列表</a></dd>
            <dd><a href="manage_job.php" >职务设置</a></dd>
        </dl>
    </div>

    <div id="member_main">
        <h2>后台管理中心</h2>
        <form action="?action=set" method="post" name="form">
            <dl>
                <dd>网站名称　　　:<input type="text" name="webname" class="text" value="<?php echo $sys['webname']?>" /></dd>
                <dd>文章每页列表数:<?php echo $sys['article_blow'];?></dd>
                <dd>博客每页列表数:<?php echo $sys['blog_blow'];?></dd>
                <dd>相册每页列表数:<?php echo $sys['photo_blow'];?></dd>
                <dd>站点默认皮肤　:<?php echo $sys['skin_blow'];?></dd>
                <dd>非法字符过滤　:<input type="text" name="string" class="text" value="<?php echo $sys['string'];?>" /></dd>
                <dd>每次发帖限制　:<?php echo $sys['post_blow'];?></dd>
                <dd>是否启用验证码:<?php echo $sys['code_blow'];?></dd>
                <dd>是否开放注册　:<?php echo $sys['register_blow'];?></dd>
                <dd><input type="submit" class="submit" value="修改系统设置"/></dd>
            </dl>
        </form>
    </div>
</div>

<!--footer-->
<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>
