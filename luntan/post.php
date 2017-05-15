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
define('CSS','post');
//引入文件
require dirname(__FILE__).'/includes/common.inc.php';//   转换绝对路径  访问速度较快
//登陆判断
if (!isset($_COOKIE['username']) || $_COOKIE['username'] == ""){
    location("请先登录!","login.php");
}
//初始化
$_GET['action'] = isset($_GET['action']) ? $_GET['action'] : "";
$_POST['type'] = isset($_POST['type']) ? $_POST['type'] : "";
$_POST['title'] = isset($_POST['title']) ? $_POST['title'] : "";
$_POST['content'] = isset($_POST['content']) ? $_POST['content'] : "";

//将帖子写入数据库
if ($_GET['action'] == 'post'){
    //验证唯一标识符
    $result = mysqli_query($link,"SELECT tg_uniqid FROM tg_user WHERE tg_username='{$_COOKIE['username']}'");
    if ($rows = mysqli_fetch_array($result,MYSQLI_ASSOC)){
        //为了防止cookie伪造,还要对比下唯一标识符
        if ($_COOKIE['uniqid'] != $rows['tg_uniqid']){
            alert_back("非法操作!");
        }
        //验证是否在规定时间外发帖
        if (time() - $_COOKIE['post_time'] < $system_set['post']){
            alert_back("一分钟只能发一帖,请休息一下!");
        }
        include ROOT_PATH.'includes/check.class.php';
        //接收帖子内容
        $clean = array();
        $clean['username'] = $_COOKIE['username'];
        $clean['type'] = $_POST['type'];
//        strlen($_POST['title']);
        $clean['title'] = mysqli_escape_string($link,check_post_title($_POST['title'],2,20));
        $clean['content'] = mysqli_escape_string($link,check_post_content($_POST['content'],10));
        //写入数据库
        mysqli_query($link,"INSERT INTO tg_article(
                                                    tg_username,
                                                    tg_title,
                                                    tg_type,
                                                    tg_content,
                                                    tg_date
                                          ) VALUES(
                                                    '{$clean['username']}',
                                                    '{$clean['title']}',
                                                    '{$clean['type']}',
                                                    '{$clean['content']}',
                                                    NOW()
                                                  )") or die("数据库连接错误 :".mysqli_error($link));
        if(mysqli_affected_rows($link) == 1){
            //获取上次操作id
            $clean['id'] = mysqli_insert_id($link);
            //生成第一次发帖cookie
            setcookie("post_time",time());
            //数据库关闭
            mysqli_close($link);
            location('发表成功!','article.php?id='.$clean['id']);
        }else{
            //数据库关闭
            mysqli_close($link);
            //跳转
            alert_back("帖子发表失败!");
        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>多用户留言系统发表帖子</title>
    <script type="text/javascript" src="js/post.js"></script>
</head>

<?php require ROOT_PATH.'includes/title.inc.php'?>

<body>
<?php require ROOT_PATH.'includes/header.inc.php'?>
<div id="post">
    <h2>发表帖子</h2>
    <form method="post" name="post" action="post.php?action=post">
        <dl>
            <dt>请认真填写以下内容</dt>
            <dd>类　型:</dd>
            <?php
                foreach(range(1,16) as $num){
                    if($num == 1){
                        echo '<label><input type="radio" id="type'.$num.'" name="type"  value="0'.$num.'" checked="checked" />';
                    }else{
                        echo '<label><input type="radio" id="type'.$num.'" name="type"  value="'.$num.'" />';
                    }
                    if ($num < 10){
                        echo ' 第0'.$num.'种</label> ';
                    }else{
                        echo ' 第'.$num.'种</label> ';
                    }
                    if ($num == 8){
                        echo "<br />";
                    }
                }
            ?>
            <dd>标　题: <input type="text" name="title" class="text" title="用户名"/>(*必填,2-20位)</dd>
            <dd id="q">贴　图:　　　<a href="javascript:;">Q图系列[1]</a>　　　<a href="javascript:;">Q图系列[2]</a>　　　<a href="javascript:;">Q图系列[3]</a></dd>
            <dd>
                <?php include ROOT_PATH.'includes/ubb.inc.php';?>
                <textarea name="content" rows="12"></textarea>
            </dd>
            <dd><input type="submit" class="submit" value="发表" /></dd>
        </dl>
    </form>
</div>
<!--footer-->
<?php require ROOT_PATH.'includes/footer.inc.php';?>

</body>
</html>
