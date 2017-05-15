<?php
/**
 * Created by PhpStorm.
 * User: 子兴的期盼
 * Date: 2016/11/2
 * Time: 20:07
 */
//防止恶意调用
if (!defined('IN_GT')){
    exit('Access Denied!');
}
//数据库关闭
mysqli_close($link);
?>

<!--页脚-->
<div id="footer">
    <p>本程序执行耗时为: <?php echo number_format(runTime() - $start_time,8);?>秒(s)</p>
    <p>版权所有 翻版必究</p>
    <p>本程序由<span>瓢城WEB俱乐部提供</span>  源代码可以任意修改或发布(C) yc60.com</p>
</div>