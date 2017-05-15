<?php
session_start();
//定义一个常量IN_GT用来授权调用includes中的文件
define('IN_GT',true);
//定义调用css常量
define('CSS','index');
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
$pagesize = $system_set['article'];
//所有的数据条数
$total = mysqli_num_rows(mysqli_query($link,"SELECT tg_id FROM tg_article WHERE tg_reid=0"));
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
$result = mysqli_query($link,"SELECT tg_id,tg_title,tg_type,tg_readcount,tg_commendcount FROM tg_article WHERE tg_reid=0 ORDER BY tg_date DESC LIMIT $pagenum,$pagesize");
//读取XML
$xml = get_XML('new.xml');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $system_set['webname'];?>--首页</title>
    <?php require ROOT_PATH.'includes/title.inc.php'?>
    <script type="text/javascript" src="js/blog.js"></script>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'?>

<div id="list">
    <h2>帖子列表</h2>
    <a href="post.php" class="post"><strong>--> 发表文章 <--<strong></a>
    <ul class="article">
        <?php while ($row=mysqli_fetch_assoc($result)){?>
            <li class="icon<?php echo $row['tg_type']?>">
                <em>
                    阅读数(<strong><?php echo $row['tg_readcount']?></strong>)
                    评论数(<strong><?php echo $row['tg_commendcount']?></strong>)
                </em>
                    <a href="article.php?id=<?php echo $row['tg_id']?>"><?php echo title($row['tg_title'],20)?></a></li>
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
    </ul>
</div>
<div id="user">
    <h2>新进会员</h2>
    <dl>
        <dd class="user"><?php echo htmlspecialchars($xml['username']);?>(<?php echo htmlspecialchars($xml['sex']);?>)</dd>
        <dt><img src="<?php echo htmlspecialchars($xml['face']);?>" alt="<?php echo htmlspecialchars($xml['username']);?>" /></dt>
        <dd class="message"><a href=javascript:; name="message" title="<?php echo $xml['id']?>" >私信</a></dd>
        <dd class="friend"><a href=javascript:; name="friend" title="<?php echo $xml['id']?>" >加为好友</a></dd>
        <dd class="guest">写留言</dd>
        <dd class="flower"><a href=javascript:; name="flower" title="<?php echo $xml['id']?>" >给他送花</a></dd>
        <dd class="email">邮件:<a href="mailto:<?php echo $xml['email'];?>"><strong><?php echo $xml['email'];?></strong></a></dd>
        <dd class="url">主页:<a href="<?php echo $xml['url'];?>" target="_blank"><strong><?php echo $xml['url'];?></strong></a></dd>
    </dl>

</div>

<div id="pics"><h2>最新图片</h2></div>

<!--footer-->
<?php require ROOT_PATH.'includes/footer.inc.php';?>

</body>
</html>
