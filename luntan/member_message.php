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
define('CSS','member_message');
//引入文件
require dirname(__FILE__).'/includes/common.inc.php';//   转换绝对路径  访问速度较快
//判断是否登陆
if (!isset($_COOKIE['username'])){
    alert_back("请先登录!");
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
$pagesize = 5;
//所有的数据条数
$total = mysqli_num_rows(mysqli_query($link,"SELECT tg_id FROM tg_message WHERE tg_touser = '{$_COOKIE['username']}'"));
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
$result = mysqli_query($link,"SELECT tg_id,tg_fromuser,tg_content,tg_date,tg_state FROM tg_message WHERE tg_touser = '{$_COOKIE['username']}' ORDER BY tg_date LIMIT $pagenum,$pagesize");

//初始化
$_GET['action'] = isset($_GET['action']) ? $_GET['action'] : "";
//批量删除
if ($_GET['action'] == 'delete' && isset($_POST['ids'])){
    $clean = array();
    $clean['ids'] = implode(',',$_POST['ids']);
    //危险操作,为了防止cookie伪造,还要对比下唯一标识符
    $result = mysqli_query($link,"SELECT tg_uniqid FROM tg_user WHERE tg_username='{$_COOKIE['username']}' LIMIT 1");
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    if($row){
        if ($row['tg_uniqid'] == $_COOKIE['uniqid']){
            mysqli_query($link,"DELETE FROM tg_message WHERE tg_id IN ({$clean['ids']})");
            if (mysqli_affected_rows($link)){
                mysqli_close($link);
                location("短信删除成功!",'member_message.php');
            }else{
                mysqli_close($link);
                alert_back("私信删除失败!");
            }
        }else{
            alert_back("非法操作!");
        }
    }
}
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
        <h2>短信管理中心</h2>
        <form method="post" action="member_message.php?action=delete">
        <table cellspacing="1">
            <tr>
                <th>发信人</th>
                <th>短信内容</th>
                <th>时间</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
           <?php while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {?>
                    <tr>
                        <td><?php echo $row['tg_fromuser'];?></td>
                        <td><a href="member_message_detail.php?id=<?php echo $row['tg_id']?>" title="<?php echo $row['tg_content']?>"><?php
                                if($row['tg_state'] == 1){echo title($row['tg_content']);}else{echo '<strong>'.title($row['tg_content']).'</strong>';} ?>
                            </a></td>
                        <td><?php echo $row['tg_date'];?></td>
                        <td><?php if ($row['tg_state'] == 1){echo "已读";}else{echo "未读";}?></td>
                        <td><input name="ids[]" value="<?php echo $row['tg_id']?>" type="checkbox"></td>
                    </tr>
           <?php }mysqli_free_result($result);?>
            <tr>
                <td colspan="5"><label>全选<input type="checkbox" name="check_all" id="all" /></label>
                    <input type="submit" value="批删除" />
                </td>
            </tr>
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
