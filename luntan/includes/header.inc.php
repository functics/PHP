<?php
/**
 * Created by PhpStorm.
 * User: 子兴的期盼
 * Date: 2016/11/2
 * Time: 20:03
 */
//防止恶意调用
if (!defined('IN_GT')){
    exit('Access Denied!');
}
?>
<div id="header">
    <h1><a href="index.php">多用户留言系统</a> </h1>
    <ul>
        <li><a href="index.php">首页</a></li>
        <?php
            if (isset($_COOKIE['username']) && $_COOKIE['username'] !== ""){
                echo '<li><a href="member.php">'.$_COOKIE['username'].'的个人中心</a>'.$GLOBALS['message'].'</li>';
                echo "\n";
            }else{
                echo '<li><a href="register.php">注册</a></li>';
                echo "\n";
                echo "\t\t";
                echo '<li><a href="login.php">登陆</a></li>';
                echo "\n";
            }
        ?>
        <li><a href="blog.php">博友</a></li>
        <li><a href="">风格</a></li>
        <?php
        if (isset($_COOKIE['username']) && isset($_SESSION['admin'])){
            echo '<li><a href="manage.php">管理 </a></li>';
        }
        if (isset($_COOKIE['username'])) {
            echo '<li><a href="loginout.php">退出</a></li>';
        }
        ?>
    </ul>
</div>
