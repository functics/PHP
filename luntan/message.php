<?php
/**
 * Created by PhpStorm.
 * User: 子兴的期盼
 * Date: 2016/11/20
 * Time: 9:30
 */
session_start();
//定义一个常量IN_GT用来授权调用includes中的文件
define('IN_GT',true);
//定义调用css常量
define('CSS','message');
//引入文件
require dirname(__FILE__).'/includes/common.inc.php';//   转换绝对路径  访问速度较快
//判断是否登录
if (!isset($_COOKIE['username']) || $_COOKIE['username'] == ""){
    alert_close("您还有没登陆");
}
//写短信
//初始化
$_GET['action'] = isset($_GET['action']) ? $_GET['action'] : "";
$_POST['touser'] = isset($_POST['touser']) ? $_POST['touser'] : "";
$_POST['content'] = isset($_POST['content']) ? $_POST['content'] : "";
$_COOKIE['uniqid'] = isset($_COOKIE['uniqid']) ? $_COOKIE['uniqid'] : "";

if ($_GET['action'] == 'write'){
    $result = mysqli_query($link,"SELECT tg_uniqid FROM tg_user WHERE tg_username='{$_COOKIE['username']}' LIMIT 1");
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    if ($row['tg_uniqid'] == $_COOKIE['uniqid']){
        include ROOT_PATH.'includes/check.class.php';
        $clean = array();
        $clean['touser'] = $_POST['touser'];
        $clean['content'] = check_content(htmlspecialchars($_POST['content']),200);
        $clean['fromuser'] = $_COOKIE['username'];
//        print_r($clean);
//        echo ("发送成功!");
        mysqli_query($link,"INSERT INTO tg_message (
                                                    tg_touser,
                                                    tg_fromuser,
                                                    tg_content,tg_date
                                                    )
                                             VALUES (
                                                    '{$clean['touser']}',
                                                    '{$clean['fromuser']}',
                                                    '{$clean['content']}',
                                                    NOW()
                                                    )") or die("查询失败".mysqli_error($link));
        //新增成功
        if(mysqli_affected_rows($link) == 1){
            //数据库关闭
            mysqli_free_result($result);
            mysqli_close($link);
            alert_back('发送成功!');

        }else{
            //数据库关闭
            mysqli_free_result($result);
            mysqli_close($link);
            //跳转
            alert_back("短信发送失败!");
        }
    }else{
        alert_back('非法登录!');
    }
}
//获取数据
if (isset($_GET['id'])){
    $result = mysqli_query($link,"SELECT tg_username FROM tg_user where tg_id = '{$_GET['id']}' LIMIT 1") or die("不存在此用户!");
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
}else{
    alert_back('非法操作!');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>多用户留言系统注册</title>
</head>

<?php require ROOT_PATH.'includes/title.inc.php'?>
<script type="text/javascript" src="js/message.js"></script>

<body>

<div id="message">
    <h3>写短信</h3>
    <form method="post" action="message.php?action=write ">
        <input type="hidden" name="touser" value="<?php echo htmlspecialchars($row['tg_username']);?>"/>
    <dl>
        <dd><input type="text" readonly="readonly" class="text" title="输入框" value="TO:<?php echo htmlspecialchars($row['tg_username']);?>"/></dd>
        <dd><textarea name="content" title="文本对话框"></textarea></dd>
        <dd><input type="submit" class="submit" value="发送" /></dd>
    </dl>
    </form>
</div>

<!--footer-->
<?php require ROOT_PATH.'includes/footer.inc.php';?>

</body>
</html>
