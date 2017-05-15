<?php
/**
 * Created by PhpStorm.
 * User: 子兴的期盼
 * Date: 2016/11/21
 * Time: 10:56
 */
session_start();
//定义一个常量IN_GT用来授权调用includes中的文件
define('IN_GT',true);
//定义调用css常量
define('CSS','manage_member');
//引入文件
require dirname(__FILE__).'/includes/common.inc.php';//   转换绝对路径  访问速度较快
//必须是管理员才能登录
if ((!isset($_SESSION['admin'])) || (!isset($_COOKIE['username']))){
    alert_back("非法操作!");
}
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
$pagesize = 8;
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
$result = mysqli_query($link,"SELECT tg_id,tg_username,tg_email,tg_reg_time FROM tg_user ORDER BY tg_reg_time DESC LIMIT $pagenum,$pagesize");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>多用户留言系统私信列表</title>
    <?php require ROOT_PATH.'includes/title.inc.php'?>
    <link rel="stylesheet" type="text/css" href="css/1/member.css" />
    <script type="text/javascript" src="js/member_message.js"></script>
</head>

<body>
<?php require ROOT_PATH.'includes/header.inc.php'?>

<div id="member">
    <div id="member_sidebar">
        <h2>管理导航</h2>
        <dl>
            <dt>系统管理</dt>
            <dd><a href="manage.php" >后台设置</a></dd>
            <dd><a href="manage_set.php" >系统设置</a></dd>
        </dl>
        <dl>
            <dt>会员管理</dt>
            <dd><a href="manage_member.php" >会员列表</a></dd>
            <dd><a href="manage_job.php" >职务设置</a></dd>
        </dl>
    </div>

    <div id="member_main">
        <h2>会员列表中心</h2>
        <form method="post" action="member_message.php?action=delete">
        <table cellspacing="1">
            <tr>
                <th>会员编号</th>
                <th>会员名称</th>
                <th>邮件地址</th>
                <th>注册时间</th>
                <th>操作</th>
            </tr>
            <?php while ($row=mysqli_fetch_assoc($result)){?>
            <tr>
                <td><?php echo $row['tg_id'];?></td>
                <td><?php echo $row['tg_username'];?></td>
                <td><?php echo $row['tg_email'];?></td>
                <td><?php echo $row['tg_reg_time'];?></td>
                <td>[删] [修]</td>
            </tr>
            <?php } mysqli_free_result($result)?>
        </table>
        </form>
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
</div>

<!--footer-->
<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>
