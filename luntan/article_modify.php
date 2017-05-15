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
define('CSS','article_modify');
//引入文件
require dirname(__FILE__).'/includes/common.inc.php';//   转换绝对路径  访问速度较快
//登陆判断
if (!isset($_COOKIE['username']) || $_COOKIE['username'] == ""){
    location("请先登录!","login.php");
}
//修改数据
if (@$_GET['action'] == "modify"){
    $query = "SELECT tg_uniqid FROM tg_user WHERE tg_username = '{$_COOKIE['username']}'";
    $result = mysqli_query($link,$query) or die("2".mysqli_error($link));
    $row = mysqli_fetch_assoc($result);
    if ($row['tg_uniqid'] != $_COOKIE['uniqid']){
        alert_back("非法操作3!");
    }else{
        //开始修改
        //先验证
        include ROOT_PATH.'includes/check.class.php';
        //接受内容
        $accept = array();
        $accept['id'] = $_POST['id'];
        $accept['title'] = mysqli_escape_string($link,check_post_title($_POST['title'],2,14));
        $accept['type'] = $_POST['type'];
        $accept['content'] = mysqli_escape_string($link,check_post_content($_POST['content'],10));
        //执行sql
        $query = "UPDATE tg_article SET 
                                        tg_type = '{$accept['type']}',
                                        tg_title = '{$accept['title']}',
                                        tg_content = '{$accept['content']}',
                                        tg_last_modify_date = NOW()
                                  WHERE
                                        tg_id = '{$accept['id']}'";
        $result = mysqli_query($link,$query) or die("3".mysqli_error($link));
        if (mysqli_affected_rows($link) == 1){
            //关闭数据库
            mysqli_close($link);
            location('修改成功!','article.php?id='.$accept['id']);
        }else{
            //关闭数据库
            mysqli_close($link);
            alert_back("修改失败!");
        }
    }
}else{
//    alert_back("非法操作2!");
}
//读取数据
if (isset($_GET['id'])){
    $query = "SELECT tg_username,tg_title,tg_type,tg_content FROM tg_article WHERE tg_reid = 0 AND tg_id='{$_GET['id']}'";
    $result = mysqli_query($link,$query) or die("1".mysqli_error($link));
    if ($row = mysqli_fetch_assoc($result)){
        $gather = array();
        $gather['id'] = $_GET['id'];
        $gather['username'] = $row['tg_username'];
        $gather['title'] = $row['tg_title'];
        $gather['type'] = $row['tg_type'];
        $gather['content'] = $row['tg_content'];
        //判断权限
        if ($gather['username'] != $_COOKIE['username']){
            alert_back("你没有权限修改!");
        }

    }else{
        alert_back("文章不存在!");
    }
}else{
    alert_back("非法操作1!");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>多用户留言系统修改帖子</title>
    <script type="text/javascript" src="js/post.js"></script>
</head>

<?php require ROOT_PATH.'includes/title.inc.php'?>

<body>
<?php require ROOT_PATH.'includes/header.inc.php'?>
<div id="post">
    <h2>修改帖子</h2>
    <form method="post" name="post" action="article_modify.php?action=modify">
        <input type="hidden" value="<?php echo $gather['id'];?>" name="id" />
        <dl>
            <dt>请认真修改以下内容</dt>
            <dd>类　型:</dd>
            <?php
                foreach(range(1,16) as $num){
                    if($num == $gather['type']){
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
            <dd>标　题: <input type="text" name="title" class="text" value="<?php echo $gather['title'];?>" title="用户名"/>(*必填,2-20位)</dd>
            <dd id="q">贴　图:　　　<a href="javascript:;">Q图系列[1]</a>　　　<a href="javascript:;">Q图系列[2]</a>　　　<a href="javascript:;">Q图系列[3]</a></dd>
            <dd>
                <?php include ROOT_PATH.'includes/ubb.inc.php';?>
                <textarea name="content" rows="12"><?php echo $gather['content'];?></textarea>
            </dd>
            <dd><input type="submit" class="submit" value="修改" /></dd>
        </dl>
    </form>
</div>
<!--footer-->
<?php require ROOT_PATH.'includes/footer.inc.php';?>

</body>
</html>
