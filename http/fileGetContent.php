<?php

$data = [
    'author' => '测试数据author',
    'mail'   => '测试数据mail',
    'text'   => '测试数据text',
];

$data = http_build_query($data);

$opts = [
    'http' => [
        'method'  => 'POST',
        'header'  => "Content-type: application/x-www-form-urlencoded" . "\r\n" .
                     "Content-Length: " . strlen($data) . "\r\n" . 
                     "Cookie: PHPSESSID=XXXXXXXXX" . "\r\n" .
                     "User-Agent: Mozilla/5.0(Windows; U; Window NT 6.1; zh-CN; rv: 1.9.2.13) Gecko/20101203 Firefox/3.6.13" . '\r\n',
                     "Referer: http://aiyooyoo.com/index.php/archives/7/",
        "content" => $data,

    ],
];
    
$context = stream_context_create($opts);

$html = @file_get_contents($url, false, $context);
