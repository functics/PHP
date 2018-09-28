<?php
// 创建一个套接字
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

// 绑定接收的套接流主机和端口,与客户端相对应;端口可以自定义，前提是没有被占用
if (!socket_bind($socket, '127.0.0.1', 80)) {
    echo 'server bind fail : ' . socket_strerror(socket_last_error());
}
// 监听套节流
if (!socket_listen($socket, 4)) {
    echo 'server losten fail : ' . socket_strerror(socket_last_error());
}

// 让服务器无限获取客户端传过来的信息
do {
    // 接收客户端传过来的信息
    $acceptResource = socket_accept($socket); // socket_accept的作用就是接受socket_bind()所绑定的主机发过来的套接流

    if ($acceptResource !== false) {
        // 读取客户端传过来的资源并且转化为字符串
        $string = socket_read($acceptResource, 1024); // socket_read的作用就是读出socket_accept()的资源并把它转化为字符串
        
        echo 'server recieve is :' . $string . PHP_EOL; // PHP_EOL为php的换行预定义常量

        if (!$string) {
            $returnClient = 'server receive is : ' . $string . PHP_EOL;
            // 向 socket_accept 的套接流写入信息，也就是回馈信息给 socket_bind() 所绑定的主机客户端
            socket_write($acceptResource, $returnClient, strlen($returnClient)); // socket_write的作用是向socket_create的套接流写入信息，或者向socket_accept的套接流写入信息
        } else {
            echo 'socket_read is fail' . PHP_EOL;
        }
        // socket_close的作用是关闭socket_create()或者socket_accept()所建立的套接流
        socket_close($acceptResource);
    }
} while (true);
// 关闭套接字连接
socket_close($socket);

// 请注意上面的socket_bind, socket_listen, socket_accept 三个函数的执行顺序不可更改，也就是说必须先执行 socket_bind , 再执行 socket_listen , 最后才执行 socket_accept
