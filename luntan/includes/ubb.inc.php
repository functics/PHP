<?php
/**
 * Created by PhpStorm.
 * User: 子兴的期盼
 * Date: 2016/11/27
 * Time: 16:55
 */
//防止恶意调用
if (!defined('IN_GT')){
    exit('Access Denied!');
}
?>
<div id="ubb">
    <!--图片用img表达-->
    <span title="字体大小">A</span>
    <span>|</span>
    <span title="粗体">B</span>
    <span title="斜体">C</span>
    <span title="下划线">D</span>
    <span title="删除线">E</span>
    <span>|</span>
    <span title="字体颜色">F</span>
    <span title="超链接">G</span>
    <span title="电子邮件">H</span>
    <span title="图片">I</span>
    <span title="Flash">J</span>
    <span title="粗体">K</span>
    <span>|</span>
    <span title="粗体">L</span>
    <span title="粗体">M</span>
    <span title="粗体">N</span>
    <span>|</span>
    <span title="增大文本框">O</span>
    <span title="缩小文本框">P</span>
    <span title="帮助">Q</span>
</div>
<div id="font">
    <strong onclick="font(10)">10px</strong>
    <strong onclick="font(12)">12px</strong>
    <strong onclick="font(14)">14px</strong>
    <strong onclick="font(16)">16px</strong>
    <strong onclick="font(18)">18px</strong>
    <strong onclick="font(20)">20px</strong>
    <strong onclick="font(22)">22px</strong>
    <strong onclick="font(24)">24px</strong>
</div>
<div id="color">
    <strong title="黑色" style="background-color: #000" onclick="showcolor('#000')"></strong>
    <strong title="褐色" style="background-color: #930" onclick="showcolor('#930')"></strong>
    <strong title="橄榄树" style="background-color: #330" onclick="showcolor('#330')"></strong>
    <strong title="深绿" style="background-color: #030" onclick="showcolor('#030')"></strong>
    <strong title="深青" style="background-color: #036" onclick="showcolor('#036')"></strong>
    <strong title="深蓝" style="background-color: #000080" onclick="showcolor('#000080')"></strong>
    <strong title="靓蓝" style="background-color: #339" onclick="showcolor('#339')"></strong>
    <strong title="灰色-80%" style="background-color: #333" onclick="showcolor('#333')"></strong>
    <strong title="深红" style="background-color: #800000" onclick="showcolor('#800000')"></strong>
    <strong title="橙红" style="background-color: #f60" onclick="showcolor('#f60')"></strong>
    <strong title="深黄" style="background-color: #808000" onclick="showcolor('#808000')"></strong>
    <strong title="深绿" style="background-color: #008000" onclick="showcolor('#008000')"></strong>
    <strong title="绿色" style="background-color: #008080" onclick="showcolor('#008080')"></strong>
    <strong title="蓝色" style="background-color: #00f" onclick="showcolor('#00f')"></strong>
    <strong title="蓝灰" style="background-color: #669" onclick="showcolor('#669')"></strong>
    <strong title="灰色-50%" style="background-color: #808080" onclick="showcolor('#808080')"></strong>
    <strong title="红色" style="background-color: #f00" onclick="showcolor('#f00')"></strong>
    <strong title="浅橙" style="background-color: #f90" onclick="showcolor('#f90')"></strong>
    <strong title="酸橙" style="background-color: #9c0" onclick="showcolor('#9c0')"></strong>
    <strong title="海绿" style="background-color: #396" onclick="showcolor('#396')"></strong>
    <strong title="水绿色" style="background-color: #3cc" onclick="showcolor('#3cc')"></strong>
    <strong title="浅蓝" style="background-color: #36f" onclick="showcolor('#36f')"></strong>
    <strong title="紫罗兰" style="background-color: #800080" onclick="showcolor('#800080')"></strong>
    <strong title="灰色-40%" style="background-color: #999" onclick="showcolor('#999')"></strong>
    <strong title="粉红" style="background-color: #f0f" onclick="showcolor('#f0f')"></strong>
    <strong title="金色" style="background-color: #fc0" onclick="showcolor('#fc0')"></strong>
    <strong title="黄色" style="background-color: #ff0" onclick="showcolor('#ff0')"></strong>
    <strong title="鲜绿" style="background-color: #0f0" onclick="showcolor('#0f0')"></strong>
    <strong title="青绿" style="background-color: #0ff" onclick="showcolor('#0ff')"></strong>
    <strong title="天蓝" style="background-color: #0cf" onclick="showcolor('#0cf')"></strong>
    <strong title="梅红" style="background-color: #936" onclick="showcolor('#936')"></strong>
    <strong title="灰色-20%" style="background-color: #c0c0c0" onclick="showcolor('#c0c0c0')"></strong>
    <strong title="玫瑰红" style="background-color: #f90" onclick="showcolor('#f90')"></strong>
    <strong title="茶色" style="background-color: #fc9" onclick="showcolor('#fc9')"></strong>
    <strong title="浅黄" style="background-color: #ff9" onclick="showcolor('#ff9')"></strong>
    <strong title="浅绿" style="background-color: #cfc" onclick="showcolor('#cfc')"></strong>
    <strong title="浅青绿" style="background-color: #cff" onclick="showcolor('#cff')"></strong>
    <strong title="浅蓝" style="background-color: #9cf" onclick="showcolor('#9cf')"></strong>
    <strong title="淡紫" style="background-color: #c9f" onclick="showcolor('#c9f')"></strong>
    <strong title="白色" style="background-color: #fff"></strong>
    <em><input type="text" name="t" value="#" /></em>
</div>
