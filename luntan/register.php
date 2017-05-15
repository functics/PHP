<?php
/**
 * Created by PhpStorm.
 * User: 子兴的期盼
 * Date: 2016/11/3
 * Time: 16:45
 */
session_start();
//定义一个常量IN_GT用来授权调用includes中的文件
define('IN_GT',true);
//定义调用css常量
define('CSS','register');
//引入文件
require dirname(__FILE__).'/includes/common.inc.php';//   转换绝对路径  访问速度较快
//登录状态判断
login_state();
//测试是否能插入数据
//mysqli_real_query($link,"INSERT INTO tg_user (tg_username1) VALUES ('何佳宁')") or die('插入失败');
//初始化
$_GET['action'] = isset($_GET['action']) ? $_GET['action'] : '';
$_POST['username'] = isset($_POST['username']) ? $_POST['username'] : "";
$_POST['password'] = isset($_POST['password']) ? $_POST['password'] : "";
$_POST['assure'] = isset($_POST['assure']) ? $_POST['assure'] : "";
$_POST['question'] = isset($_POST['question']) ? $_POST['question'] : "";
$_POST['answer'] = isset($_POST['answer']) ? $_POST['answer'] : "";
$_POST['sex'] = isset($_POST['sex']) ? $_POST['sex'] : "";
$_POST['face'] = isset($_POST['face']) ? $_POST['face'] : "";
$_POST['email'] = isset($_POST['email']) ? $_POST['email'] : "";
$_POST['qq'] = isset($_POST['qq']) ? $_POST['qq'] : "";
$_POST['face'] = isset($_POST['face']) ? $_POST['face'] : "";
$_POST['yzm'] = isset($_POST['yzm']) ? $_POST['yzm'] : "";
$_POST['uniqid'] = isset($_POST['uniqid']) ? $_POST['uniqid'] : "";
//判断是否提交了
if (empty($system_set['register'])){
    alert_back("本站目前不开放注册!");
}
if ($_GET['action'] == 'register'){
    //为了防止恶意注册,跨站攻击.
    check_code($_POST['yzm'],$_SESSION['code']);
    //引入验证文件
    include ROOT_PATH.'includes/check.class.php';
    //创建一个空数组,用来存放提交过来的合法数据
    $clean = array();
    //可以使用唯一标识符来防止恶意注册,伪装表单跨站攻击等.
    //第二个用途就是登录时的cookies验证;
    $clean['uniqid'] = check_uniqid($_POST['uniqid'],$_SESSION['uniqid']);
    //active也是一个唯一标识符,用来对刚注册的用户的激活操作.
    $clean['active'] = sha1(uniqid(rand(),true));
    $clean['username'] = check_username($_POST['username']);
    $clean['password'] = check_password($_POST['password'],$_POST['assure'],6);
    $clean['question'] = check_question($_POST['question']);
    $clean['answer'] = check_answer($_POST['question'],$_POST['answer']);
    $clean['sex'] = $_POST['sex'];
    $clean['face'] = $_POST['face'];
    $clean['email'] = check_email($_POST['email']);
    $clean['qq'] = check_QQ($_POST['qq']);
    $clean['url'] = check_url($_POST['url']);
//    print_r($clean);
    //新增前判断用户名是否重复
    $query = mysqli_query($link,"SELECT tg_username FROM tg_user WHERE tg_username = '{$clean['username']}'") or die(mysqli_error($link));
    if (mysqli_fetch_array($query,MYSQLI_ASSOC)){
        alert_back('对不起,此用户已被注册!');
    }
    //新增用户
    //在双引号里,直接放变量是可以的,比如$,但是如果是数组,就必须加上{},比如($clean['username']).
    mysqli_real_query($link,"INSERT INTO tg_user (
                                                  tg_uniqid,
                                                  tg_active,
                                                  tg_username,
                                                  tg_password,
                                                  tg_question,
                                                  tg_answer,
                                                  tg_sex,
                                                  tg_face,
                                                  tg_email,
                                                  tg_qq,
                                                  tg_url,
                                                  tg_reg_time,
                                                  tg_last_time,
                                                  tg_last_ip
                                                  ) 
                                         VALUES (
                                                  '{$clean['uniqid']}',
                                                  '{$clean['active']}',
                                                  '{$clean['username']}',
                                                  '{$clean['password']}',
                                                  '{$clean['question']}',
                                                  '{$clean['answer']}',
                                                  '{$clean['sex']}',
                                                  '{$clean['face']}',
                                                  '{$clean['email']}',
                                                  '{$clean['qq']}',
                                                  '{$clean['url']}',
                                                  NOW(),
                                                  NOW(),
                                                  '{$_SERVER["REMOTE_ADDR"]}'
                                                  )") or die('插入失败'.mysqli_error($link));
    if(mysqli_affected_rows($link) == 1){
        //数据库关闭
        //获取最近操作该条信息的id
        $clean['id'] = mysqli_insert_id($link);
        mysqli_close($link);
        //生成XML
        create_XML("new.xml",$clean);
        location('恭喜您注册成功!','active.php?active='.$clean['active']);
    }else{
        //数据库关闭
        mysqli_close($link);
        //跳转
        location("很遗憾,注册失败!","register.php");
    }
}else{
    $_SESSION['uniqid'] = $_uniqid= sha1(uniqid(rand(),true));
//    echo $_SESSION['uniqid'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>多用户留言系统注册</title>
</head>

<?php require ROOT_PATH.'includes/title.inc.php'?>
<script type="text/javascript" src="js/register.js"></script>

<body>
<?php require ROOT_PATH.'includes/header.inc.php'?>
<div id="register">
    <h2>会员注册</h2>
    <form method="post" name="register" action="register.php?action=register">
        <input type="hidden" name="uniqid" value="<?php echo $_uniqid;?>"/>
        <dl>
            <dt>请认真填写以下内容</dt>
            <dd>用户名&#x3000;: <input type="text" name="username" class="text" title="用户名"/>(*必填,2-20位)</dd>
            <dd>密&#x3000;&#x3000;码: <input type="password" name="password" class="text" title="密码"/>(*必填,至少6位)</dd>
            <dd>确认密码: <input type="password" name="assure" class="text" title="确认密码"/>(*必填,至少6位)</dd>
            <dd>密码提示: <input type="text" name="question" class="text" title="密码提示"/>(*必填,至少2位)</dd>
            <dd>密码回答: <input type="text" name="answer" class="text" title="密码回答"/>(*必填,至少2位)</dd>
            <dd>性&#x3000;&#x3000;别: <input type="radio" name="sex" value="男" checked="checked" title="男"/>男&#x3000;&#x3000;
                <input type="radio" name="sex" value="女" title="女"/>女</dd>
            <dd class="face"><input type="hidden" name="face" value="face/01.jpg" id="face"/><img src="face/01.jpg" alt="头像选择" id="faceimg"/></dd>
            <dd>电子邮件: <input type="text" name="email" class="text" title="电子邮件"/>(*必填,激活账户)</dd>
            <dd>Q&#x3000;&nbsp;&nbsp;&#x3000;Q: <input type="text" name="qq" class="text" title="QQ"/></dd>
            <dd>主页地址: <input type="text" name="url" class="text" title="主页地址" value="http://"/></dd>
            <dd>验证码&#x3000;: <input type="text" name="yzm" class="text yzm" title="验证码"/><img src="code.php" id="code" alt="验证码"/></dd>
            <dd><input type="submit" name="submit" class="submit" value="注册"/></dd>
        </dl>
    </form>
</div>
<!--footer-->
<?php require ROOT_PATH.'includes/footer.inc.php';?>

</body>
</html>
