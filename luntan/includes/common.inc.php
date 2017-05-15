<?php
/**
 * Created by PhpStorm.
 * User: 子兴的期盼
 * Date: 2016/11/2
 * Time: 20:24
 */
//防止恶意调用
if (!defined('IN_GT')){
    exit('Access Denied!');
}
//设置字符集编码
header("Content-Type:text/html;charset=utf-8");
//转换为绝对路径
define('ROOT_PATH',substr(dirname(__FILE__),0,-8));
//PHP版本
if (PHP_VERSION < '4.0.1'){
    exit("Your PHP version is too low");
}
//引入核心类库
require ROOT_PATH.'includes/global.func.php';
//执行耗时
$start_time = runTime();
//数据库连接
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PWD','root');
define('DB_NAME','luntan');
$link = @mysqli_connect(DB_HOST,DB_USER,DB_PWD) or die('Connect Error'.mysqli_error($link));
//$link = mysqli_connect('localhost','root','root') or die('Connect Error'.mysqli_connect_errno());
//选择一个数据库
mysqli_select_db($link,DB_NAME) or die('The database don\'t exist');
//选择字符集
mysqli_query($link,'SET NAMES UTF8') or die('字符集错误');
//短信提醒
$result_message = mysqli_query($link,"SELECT COUNT(tg_id) AS count FROM tg_message WHERE tg_state=0 AND tg_touser = '{$_COOKIE['username']}'");
$_message = mysqli_fetch_array($result_message,MYSQLI_ASSOC);
if ($_message['count'] == 0){
    $GLOBALS['message'] = '<a href="member_message.php"><strong>('.(0).')</strong></a>';
}else{
    $GLOBALS['message'] = '<a href="member_message.php"><strong>('.$_message['count'].')</strong></a>';
}
//系统设置初始化
//读取系统表
$query = "SELECT * FROM tg_system WHERE tg_id = 1";
$result = mysqli_query($link,$query);
$row = mysqli_fetch_assoc($result);
if ($row){
    $system_set = array();
    $system_set['webname'] = $row['tg_webname'];
    $system_set['article'] = $row['tg_article'];
    $system_set['blog'] = $row['tg_blog'];
    $system_set['photo'] = $row['tg_photo'];
    $system_set['skin'] = $row['tg_skin'];
    $system_set['post'] = $row['tg_post'];
    $system_set['code'] = $row['tg_code'];
    $system_set['register'] = $row['tg_register'];
    $system_set['string'] = $row['tg_string'];
}else{
    alert_back("系统表异常,请联系管理员!");
}
?>