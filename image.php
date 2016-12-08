<?php
    //一般生成的图像可能是jpg,png,gif,bmp

    //第一步,设置文件MIME类型,输出类型,将输出类型改为图像流
    header('Content-Type = "image/png";');

    //第二步,创建一个图形区域,图像背景.两种创建方式:资源类型,一般要加上@符号,防止出错
    $img = imagecreatetruecolor(200, 200);//返回资源句柄,200,200分别为xy坐标

    //第三步,在空白区域绘制颜色,文字,线条等
    //填充色换掉首先需要一个颜色填充器
    $blue = imagecolorallocate($img, 0, 0, 255);//背景色
    $white = imagecolorallocate($img, 255, 255, 255);//白色线条
    $red = imagecolorallocate($img, 255, 0, 0);//文字
    //将颜色填充上去,imagefill--区域填充
    imagefill($img, 0, 0, $blue);

    //第四步,在之前背景上画一些线条或者文字
    //imageline--画一条线段
    //画了个X号
    imageline($img, 0, 0, 200, 200, $white);
    imageline($img, 0, 200, 200, 0, $white);
    //imagestring--水平的写一个字符串
    imagestring($img, 5, 100, 100, "U", $red);


    //第五步,输出最终图形,以png格式将图像输出到浏览器或文件
    imagepng($img);//里面放资源句柄

    //第六步,将所有资源清空
    imagedestroy($img);
?>