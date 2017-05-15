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
define('CSS','article');
//引入文件
require dirname(__FILE__).'/includes/common.inc.php';//   转换绝对路径  访问速度较快
//初始化
$_POST['reid'] = isset($_POST['reid']) ? $_POST['reid'] : "";
if (@$_GET['action'] == "rearticle"){
    //验证唯一标识符
    $result = mysqli_query($link,"SELECT tg_uniqid FROM tg_user WHERE tg_username='{$_COOKIE['username']}'");
    if ($rows = mysqli_fetch_assoc($result)){
        //为了防止cookie伪造,还要对比下唯一标识符
        if ($_COOKIE['uniqid'] != $rows['tg_uniqid']){
            alert_back("非法操作!");
        }
        include ROOT_PATH.'includes/check.class.php';
        //接收帖子内容
        $clean = array();
        $clean['reid'] = $_POST['reid'];
        $clean['type'] = $_POST['type'];
        $clean['title'] = mysqli_escape_string($link,check_post_title(@$_POST['title'],2,20));
        $clean['content'] = mysqli_escape_string($link,check_post_content(@$_POST['content'],10));
        $clean['username'] = $_COOKIE['username'];
        //写入数据库
        $result= mysqli_query($link,"INSERT INTO tg_article (
                                                              tg_reid,
                                                              tg_username,
                                                              tg_title,
                                                              tg_type,
                                                              tg_content,
                                                              tg_date
                                                            ) 
                                                    VALUES (
                                                              '{$clean['reid']}',
                                                              '{$clean['username']}',
                                                              '{$clean['title']}',
                                                              '{$clean['type']}',
                                                              '{$clean['content']}',
                                                              NOW()
                                                            )
        ");
        if(mysqli_affected_rows($link) == 1){
            //评论量加1
            $result = mysqli_query($link,"UPDATE tg_article SET tg_commendcount = tg_commendcount + 1 WHERE tg_reid = 0 AND tg_id = '{$clean['reid']}'");
            //数据库关闭
            mysqli_close($link);
            location('回帖成功!','article.php?id='.$clean['reid']);
        }else{
            //数据库关闭
            mysqli_close($link);
            //跳转
            alert_back("回帖失败!");
        }
    }
}
//读数据
if (isset($_GET['id'])){
    $result = mysqli_query($link,"SELECT * FROM tg_article WHERE tg_reid=0 AND tg_id = '{$_GET['id']}'");
    $row = mysqli_fetch_assoc($result);
    if (!$row){
        alert_back("这篇文章不存在!");
    }
    mysqli_query($link,"UPDATE tg_article SET tg_readcount = tg_readcount + 1 WHERE tg_id = '{$_GET['id']}'");
    //拿出用户名去查找用户信息
    $result2 = mysqli_query($link,"SELECT tg_user.tg_id,tg_sex,tg_face,tg_switch,tg_autograph,tg_email,tg_url FROM tg_user,tg_article WHERE tg_user.tg_username = tg_article.tg_username") or die("连接失败 :".mysqli_error($link));
    $row2 = mysqli_fetch_assoc($result2);
    if (!$row2){
        alert_back("该用户已删除!");
    }
    //读取最后修改信息
    if ($row['tg_last_modify_date'] != "0000-00-00 00:00:00"){
        $last_modify_date_string = "本帖被[".$row['tg_username']."]于".$row['tg_last_modify_date']."修改过";
    }
    //读取回帖
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
    $pagesize = 2;
    //所有的数据条数
    $total = mysqli_num_rows(mysqli_query($link,"SELECT tg_id FROM tg_article WHERE tg_reid='{$row['tg_id']}'"));
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
    $result_page = mysqli_query($link,"SELECT * FROM tg_article WHERE tg_reid='{$row['tg_id']}' ORDER BY tg_date ASC LIMIT $pagenum,$pagesize");
}else{
    alert_back("非法操作id值不存在!");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>多用户留言系统帖子详情</title>
    <?php require ROOT_PATH.'includes/title.inc.php'?>
    <script type="text/javascript" src="js/post.js"></script>
</head>
<body>
<?php require ROOT_PATH.'includes/header.inc.php'?>
<div id="article">
    <h2>帖子详情</h2>
    <?php
        if ($page == 1){
    ?>
    <div id="subject">
        <dl>
            <dd class="user"><?php echo $row['tg_username'];?>(<?php echo $row2['tg_sex'];?>)[楼主]</dd>
            <dt><img src="<?php echo $row2['tg_face'];?>" alt="<?php echo $row['tg_username'];?>" /></dt>
            <dd class="message"><a href=javascript:; name="message" title="<?php echo $row2['tg_id']?>" >私信</a></dd>
            <dd class="friend"><a href=javascript:; name="friend" title="<?php echo $row2['tg_id']?>" >加为好友</a></dd>
            <dd class="guest">写留言</dd>
            <dd class="flower"><a href=javascript:; name="flower" title="<?php echo $row2['tg_id']?>" >给他送花</a></dd>
            <dd class="email">邮件:<a href="mailto:<?php echo $row2['tg_email'];?>"><strong><?php echo $row2['tg_email'];?></strong></a></dd>
            <dd class="url">主页:<a href="<?php echo $row2['tg_url'];?>" target="_blank"><strong><?php echo $row2['tg_url'];?></strong></a></dd>
        </dl>
    </div>
    <div class="content">
        <div class="user">
            <span><?php
                if ($row['tg_username'] == $_COOKIE['username']){
                    echo '<a href="article_modify.php?id='.$row['tg_id'].'">[修改]</a>';
                }
                ?>1#</span><?php echo $row['tg_username']?>|发表于 : <?php echo $row['tg_date']?>
        </div>
        <h3><?php echo $row['tg_title']?>-类型 :<?php echo $row['tg_type']?><?php if($_COOKIE['username'] != ""){?><span><a href="#ree" name="re" title="回复楼主<?php echo $row3['tg_username']?>">　[回复]</a><?php }?></h3>
        <div class="detail">
            <?php echo ubb($row['tg_content'])?>
            <p class="autograph"><?php
                if ($row2['tg_switch'] == 1){
                    echo ubb($row2['tg_autograph']);
                }
                ?></p>
        </div>
        <div class="read">
            <p class="last_modify_date"><?php echo @$last_modify_date_string;?></p>
            <p>阅读量 : (<?php echo $row['tg_readcount']?>)|评论量 : (<?php echo $row['tg_commendcount']?>)</p>
        </div>
    </div>
    <?php
        }
    ?>
    <p class="line"></p>

    <?php
        $i = 2;
        while ($row3=mysqli_fetch_assoc($result_page)){
        $result2 = mysqli_query($link,"SELECT tg_id,tg_sex,tg_face,tg_switch,tg_autograph,tg_email,tg_url FROM tg_user WHERE tg_username = '{$row3['tg_username']}'") or die("连接失败 :".mysqli_error($link));
        $row2 = mysqli_fetch_assoc($result2);
        if (!$row2){
            alert_back("该用户已删除!");
        }
        ?>
    <div class="re">
        <dl>
            <dd class="user"><?php echo $row3['tg_username'];?>(<?php echo $row2['tg_sex'];?>)<?php
                if ($row3['tg_username'] != $row['tg_username']){
                   $floor .= "[沙发]";
                }else{
                    echo "[楼主]";
                }
                $floor = isset($floor) ? $floor : "";
                if ($floor != "[沙发]"){
                    $floor = "";
                }
                echo $floor;
                ?></dd>
            <dt><img src="<?php echo $row2['tg_face'];?>" alt="<?php echo $row3['tg_username'];?>" /></dt>
            <dd class="message"><a href=javascript:; name="message" title="<?php echo $row2['tg_id']?>" >私信</a></dd>
            <dd class="friend"><a href=javascript:; name="friend" title="<?php echo $row2['tg_id']?>" >加为好友</a></dd>
            <dd class="guest">写留言</dd>
            <dd class="flower"><a href=javascript:; name="flower" title="<?php echo $row2['tg_id']?>" >给他送花</a></dd>
            <dd class="email">邮件:<a href="mailto:<?php echo $row2['tg_email'];?>"><strong><?php echo $row2['tg_email'];?></strong></a></dd>
            <dd class="url">主页:<a href="<?php echo $row2['tg_url'];?>" target="_blank"><strong><?php echo $row2['tg_url'];?></strong></a></dd>
        </dl>
    </div>
    <div class="content">
        <div class="user">
            <span><?php echo ($i + ($page - 1) * $pagesize);?>#</span><?php echo $row3['tg_username']?>|发表于 : <?php echo $row3['tg_date']?>
        </div>
        <h3><?php echo $row3['tg_title']?>-类型 :<?php echo $row3['tg_type']?><?php if($_COOKIE['username'] != ""){?><span><a href="#ree" name="re" title="回复<?php echo ($i + ($page - 1) * $pagesize);?>楼的<?php echo $row3['tg_username']?>">　[回复]</a></span><?php }?></h3>
        <div class="detail">
            <?php echo ubb($row3['tg_content']);?>
            <p class="autograph"><?php
                if ($row2['tg_switch'] == 1){
                    echo ubb($row2['tg_autograph']);
                }
                ?></p>
        </div>
    </div>
    <p class="line"></p>
    <?php
        $i++;
    }
        mysqli_free_result($result_page);
    ?>

    <div id="page_num">
        <ul>
            <li class="page_unclick"><?php echo $page;?>/<?php echo $page_click;?>页</li>
            <li><a href="<?php echo CSS?>.php?id=<?php echo $row['tg_id'];?>&page=1">首页</a></li>
            <?php
            if ($page !== 1){
                echo '<li><a href="'.CSS.'.php?id='.$row['tg_id'].'&page='.($page-1).'" >上一页</a></li>';
                echo "\n";
            }
            ?>
            <?php for ($i=1;$i<=$page_click;$i++){
                if ($page == $i){
                    echo '<li><a href="'.CSS.'.php?id='.$row['tg_id'].'&page='.$i.'" class="selected">'.$i.'</a></li>';
                    echo "\n\t";
                }else {
                    echo '<li><a href="'.CSS.'.php?id='.$row['tg_id'].'&page='.$i.'">'.$i.'</a></li>';
                    echo "\n";
                }
            }?>
            <?php
            if ($page != $page_click){
                echo '<li><a href="'.CSS.'.php?id='.$row['tg_id'].'&page='.($page+1).'" >下一页</a></li>';
                echo "\n";
            }
            ?>
            <li><a href="<?php echo CSS?>.php?id=<?php echo $row['tg_id'];?>&page=<?php echo $page_click;?>">末页</a></li>
            <li class="page_unclick">共<?php echo $total;?>个</li>
        </ul>
    </div>
<!--    登陆才显示界面-->
    <?php if (isset($_COOKIE['username']) && $_COOKIE['username'] != ""){?>
        <a name="ree"></a>
    <form action="article.php?action=rearticle" method="post">
        <input type="hidden" name="reid" value="<?php echo $row['tg_id'];?>" />
        <input type="hidden" name="type" value="<?php echo $row['tg_type'];?>" />
        <dl>
            <dd>标　题: <input type="text" name="title" class="text" title="用户名" readonly="readonly" value="RE :<?php echo $row['tg_title'];?>"/></dd>
            <dd id="q">贴　图:　　　<a href="javascript:;">Q图系列[1]</a>　　　<a href="javascript:;">Q图系列[2]</a>　　　<a href="javascript:;">Q图系列[3]</a></dd>
            <dd>
                <?php include ROOT_PATH.'includes/ubb.inc.php';?>
                <textarea name="content" rows="12"></textarea>
            </dd>
            <dd><input type="submit" class="submit" value="发表" /></dd>
        </dl>
    </form>
    <?php }?>
</div>
<!--footer-->
<?php require ROOT_PATH.'includes/footer.inc.php';?>
</body>
</html>