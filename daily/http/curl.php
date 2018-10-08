<?php
// 数据处理
$data = [

];
// 使用 cURL 函数的基本思想是先使用 curl_init() 初始化 cURL会话
$ch = curl_init();
// 接着可以通过 curl_setopt() 设置需要的全部选项
curl_setOpt($ch, CURLOPT_URL, 'http://www.wdtcrmb.com/api/alter_password');
// 然后使用 curl_exec() 来执行会话
$result = curl_exec($ch);
// 执行完会话后使用 curl_close() 关闭会话
curl_close($ch);

print_r($result);
