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
define('CSS','member_modify');
//引入文件
require dirname(__FILE__).'/includes/common.inc.php';//   转换绝对路径  访问速度较快
//初始化
$_GET['action'] = isset($_GET['action']) ? $_GET['action'] : "";
$_POST['yzm'] = isset($_POST['yzm']) ? $_POST['yzm'] : "";
//修改资料
if ($_GET['action'] == 'modify'){
    //为了防止恶意注册,跨站攻击.
    check_code($_POST['yzm'],$_SESSION['code']);
    $result = mysqli_query($link,"SELECT tg_uniqid FROM tg_user WHERE tg_username='{$_COOKIE['username']}'");
    if ($rows = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        //为了防止cookie伪造,还要对比下唯一标识符
        if ($_COOKIE['uniqid'] !== $rows['tg_uniqid']){
            alert_back("非法操作!");
        }
        //引入验证文件
        include ROOT_PATH.'includes/check.class.php';
        //创建一个空数组,用来存放提交过来的合法数据
        $clean = array();
        $clean['sex'] = $_POST['sex'];
        $clean['face'] = $_POST['face'];
        $clean['email'] = check_email($_POST['email']);
        $clean['qq'] = check_QQ($_POST['qq']);
        $clean['url'] = check_url($_POST['url']);
        $clean['switch'] = $_POST['switch'];
        $clean['autograph'] = check_content($_POST['autograph'],200);
        //数据库操作
        mysqli_query($link,"UPDATE tg_user SET 
                                              tg_sex='{$clean['sex']}',
                                              tg_face='{$clean['face']}',
                                              tg_email='{$clean['email']}',
                                              tg_qq='{$clean['qq']}',
                                              tg_url='{$clean['url']}',
                                              tg_switch='{$clean['switch']}',
                                              tg_autograph='{$clean['autograph']}'
                                          WHERE 
                                              tg_username='{$_COOKIE['username']}'
                                          ")
        or die("sql错误".mysqli_error($link));
        //判断是否修改成功
        if(mysqli_affected_rows($link) == 1){
            //数据库关闭
            mysqli_close($link);
            location('恭喜您修改成功!','member.php');
        }else{
            //数据库关闭
            mysqli_close($link);
            //跳转
            location("资料未修改!","member_modify.php");
        }
    }
}

//是否正常登陆
if (isset($_COOKIE['username'])){
    //获取数据
    $result = mysqli_query($link,"SELECT tg_username,tg_sex,tg_face,tg_switch,tg_autograph,tg_email,tg_url,tg_qq FROM tg_user WHERE tg_username='{$_COOKIE['username']}'");
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    if ($row){
        foreach ($row as $key => $value){
            $row[$key] = htmlspecialchars($value);
        }
    }else{
        alert_back('此用户不存在!');
    }
}else{
    alert_back('非法登陆!');
}
mysqli_free_result($result);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>多用户留言系统会员中心</title>
    <?php require ROOT_PATH.'includes/title.inc.php'?>
    <script type="text/javascript" src="js/member_modify.js"></script>
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
        <form name="modify" method="post" action="member_modify.php?action=modify">
        <dl>
            <dd>用 &nbsp;户&nbsp; 名:<?php echo $row['tg_username'];?></dd>
            <dd>性　　别:<?php if ($row['tg_sex'] == "男"){
                   echo '<input type="radio" value="男" title="男" name="sex" class="sex" checked="checked"/>男
                         <input type="radio" value="女" title="女" name="sex" class="sex"/>女';
                }elseif($row['tg_sex'] == "女"){
                   echo '<input type="radio" value="男" title="男" name="sex" class="sex" />男
                         <input type="radio" value="女" title="女" name="sex" class="sex" checked="checked"/>女';
                }
                ?></dd>
            <dd>头　　像:<?php echo '<input type="hidden" name="face" value="'.$row['tg_face'].'" id="face"/>
                                    <img src="'.$row['tg_face'].'" alt="头像选择" id="faceimg"/>'
                    ?>
            </dd>
            <dd>电子邮件:<input type="text" name="email" class="text" title="电子邮件" value="<?php echo $row['tg_email'];?>" />(与注册时要求相同)</dd>
            <dd>主　　页:<input type="text" name="url" class="text" title="主页" value="<?php echo $row['tg_url'];?>" />(第一次写主页需要加上http://)</dd>
            <dd>Q 　　 Q:<input type="text" name="qq" class="text" title="qq" value="<?php echo $row['tg_qq'];?>" />((与注册时要求相同)</dd>
            <dd>个性签名:
                <?php if ($row['tg_switch'] == 1){ ?>
                <input type="radio" name="switch" value="1" checked="checked">启用<input type="radio" name="switch" value="0">禁用　[可以使用UBB代码]<p><textarea name="autograph"><?php echo $row['tg_autograph'];?></textarea></p></dd>
                <?php }elseif($row['tg_switch'] == 0){?>
                <input type="radio" name="switch" value="1">启用<input type="radio" name="switch" value="0" checked="checked">禁用　[可以使用UBB代码]<p><textarea name="autograph"><?php echo $row['tg_autograph'];?></textarea></p></dd>
                <?php }?>
            <dd>验 &nbsp;证 &nbsp;码: <input type="text" name="yzm" class="text yzm" title="验证码"/><img src="code.php" id="code" alt="验证码"/><input type="submit" name="submit" class="submit" value="修改资料"/></dd>
        </dl>
        </form>
    </div>
</div>

<!--footer-->
<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>
