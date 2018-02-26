<?php
    // header(type="text/html";charset="utf8");
    header("Content-Type:text/html;charset=utf-8");
    $mysqli = new mysqli();
    //连接
    @$mysqli -> connect("localhost","root","root","luntan");

    //错误判断
    if (mysqli_connect_errno()) {
        echo "数据库连接错误".mysqli_connect_error();
    }

    //关闭
    $mysqli -> close();
?>