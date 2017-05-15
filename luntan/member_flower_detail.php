<?php
/**
 * Created by PhpStorm.
 * User: 子兴的期盼
 * Date: 2016/11/21
 * Time: 15:13
 */
mysqli_free_result($result);
//定义一个常量IN_GT用来授权调用includes中的文件
define('IN_GT',true);
//定义调用css常量
define('CSS','member_message_detail');
//引入文件
require dirname(__FILE__).'/includes/common.inc.php';//   转换绝对路径  访问速度较快
//判断是否登陆
if (!isset($_COOKIE['username'])){
    alert_back("请先登录!");
}
if (isset($_GET['id'])){
    //初始化
    $_GET['id'] = isset($_GET['id']) ? $_GET['id'] : "";
//查询数据库
    $result = mysqli_query($link,"SELECT tg_id,tg_fromuser,tg_content,tg_date,tg_flowers FROM tg_flower WHERE tg_id ='{$_GET['id']}' LIMIT 1");
    $row = mysqli_fetch_assoc($result);
    if (!$row){
        alert_back("此消息不存在!");
    }
}
//删除模块
//初始化
$_GET['action'] = isset($_GET['action']) ? $_GET['action'] : "";
if ($_GET['action'] == 'delete' && $_GET['id']){
    //验证私信是否合法
    $result = mysqli_query($link,"SELECT tg_id FROM tg_flower WHERE tg_id ='{$_GET['id']}' LIMIT 1");
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    if ($row){
        //比对唯一标识符
        $result_uni = mysqli_query($link,"SELECT tg_uniqid FROM tg_user WHERE tg_uniqid ='{$_COOKIE['uniqid']}' LIMIT 1");
        $row_uni = mysqli_fetch_array($result_uni,MYSQLI_ASSOC);
        if ($row_uni){
            if ($row_uni['tg_uniqid'] !== $_COOKIE['uniqid']){
                alert_back("非法操作2!");
            }
            //删除单条私信
            mysqli_query($link,"DELETE FROM tg_flower WHERE tg_id='{$_GET['id']}' LIMIT 1");
            if(mysqli_affected_rows($link) == 1){
                //数据库关闭
                mysqli_free_result($result_uni);
                mysqli_close($link);
                location('删除成功!','member_flower.php');
            }else{
                //数据库关闭
                mysqli_free_result($result_uni);
                mysqli_close($link);
                //跳转
                alert_back("短信删除失败!");
            }
        }else{
            alert_back("非法操作1!");
        }
        alert_back("删除操作!") ;
    }else{
        alert_back("此短信不存在!");
    }
    mysqli_free_result($result);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>多用户留言系统私信详情</title>
<?php require ROOT_PATH.'includes/title.inc.php'?>
<link rel="stylesheet" type="text/css" href="css/1/member.css" />
<script type="text/javascript" src="js/member_flower_detail.js"></script>
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
        <h2>送花详情</h2>
        <dl>
            <dd>送 花 人:<?php echo $row['tg_fromuser']?></dd>
            <dd>内　　容:<br /><strong><?php echo $row['tg_content']?></strong></dd>
            <dd>花朵数目:<?php echo $row['tg_flowers']?>朵</dd>
            <dd>送花时间:<?php echo $row['tg_date']?></dd>
            <dd class="button"><input type="button" value="返回列表" id="return"/>
                <input type="button" value="删除花朵" name="<?php echo $row['tg_id']?>" id="delete"/></dd>
        </dl>
    </div>
</div>
<!--footer-->
<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>
