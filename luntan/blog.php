<?php
/**
 * Created by PhpStorm.
 * User: 子兴的期盼
 * Date: 2016/11/14
 * Time: 15:17
 */
session_start();
//定义一个常量IN_GT用来授权调用includes中的文件
define('IN_GT',true);
//定义调用css常量
define('CSS','blog');
//引入文件
require dirname(__FILE__).'/includes/common.inc.php';//   转换绝对路径  访问速度较快
//分页模版
//初始化
//@param $page      url上的页码
//@param $pagesize  每页显示多少条记录
//@param $pagenum   每页从第几条开始(在数据库中从第几条开始查询)
//@param $total     所查询的数据分页的总数
//@param $page_click
$_GET['page'] = isset($_GET['page']) ? $_GET['page'] : "1";
$page = $_GET['page'];
//判断$page的值,使其必须为整数
if (empty($_GET['page']) || $page < 0 || !is_numeric($page)){
    $page = 1;
}else{
    $page = intval($page);
}
//变量的赋值
$pagesize = $system_set['blog'];
//所有的数据条数
$total = mysqli_num_rows(mysqli_query($link,"SELECT tg_id FROM tg_user"));
//数据库清零判断
if ($total == 0){
    $page_click = 1;
}else{
    $page_click = ceil($total / $pagesize);
}
if ($page > $page_click){
    $page = $page_click;
}
$pagenum = ($page - 1) * $pagesize;
//从数据库中选择数据,获取结果集
$result = mysqli_query($link,"SELECT tg_id,tg_username,tg_sex,tg_face FROM tg_user ORDER BY tg_reg_time DESC LIMIT $pagenum,$pagesize");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>多用户留言系统注册</title>
</head>

<?php require ROOT_PATH.'includes/title.inc.php'?>
<script type="text/javascript" src="js/blog.js"></script>

<body>
<?php require ROOT_PATH.'includes/header.inc.php'?>

<div id="blog">
    <h2>博友列表</h2>
    <?php while ($row=mysqli_fetch_assoc($result)){?>
    <dl>
        <dd class="user"><?php echo htmlspecialchars($row['tg_username']);?>(<?php echo htmlspecialchars($row['tg_sex']);?>)</dd>
        <dt><img src="<?php echo htmlspecialchars($row['tg_face']);?>" alt="炎日" /></dt>
        <dd class="message"><a href=javascript:; name="message" title="<?php echo $row['tg_id']?>" >私信</a></dd>
        <dd class="friend"><a href=javascript:; name="friend" title="<?php echo $row['tg_id']?>" >加为好友</a></dd>
        <dd class="guest">写留言</dd>
        <dd class="flower"><a href=javascript:; name="flower" title="<?php echo $row['tg_id']?>" >给他送花</a></dd>
    </dl>
    <?php }
    mysqli_free_result($result);
    ?>
    <div id="page_num">
        <ul>
            <li class="page_unclick"><?php echo $page;?>/<?php echo $page_click;?>页</li>
            <li><a href="<?php echo CSS?>.php?page=1">首页</a></li>
            <?php
            if ($page !== 1){
                echo '<li><a href="'.CSS.'.php?page='.($page-1).'" >上一页</a></li>';
                echo "\n";
            }
            ?>
            <?php for ($i=1;$i<=$page_click;$i++){
                if ($page == $i){
                    echo '<li><a href="'.CSS.'.php?page='.$i.'" class="selected">'.$i.'</a></li>';
                    echo "\n\t";
                }else {
                    echo '<li><a href="'.CSS.'.php?page='.$i.'">'.$i.'</a></li>';
                    echo "\n";
                }
            }?>
            <?php
            if ($page != $page_click){
                echo '<li><a href="'.CSS.'.php?page='.($page+1).'" >下一页</a></li>';
                echo "\n";
            }
            ?>
            <li><a href="<?php echo CSS?>.php?page=<?php echo $page_click;?>">末页</a></li>
            <li class="page_unclick">共<?php echo $total;?>个</li>
        </ul>
    </div>
</div>

<!--footer-->
<?php require ROOT_PATH.'includes/footer.inc.php';?>

</body>
</html>

