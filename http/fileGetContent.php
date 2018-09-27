<?php

$data = [
    'author' => '测试数据author',
    'mail'   => '测试数据mail',
    'text'   => '测试数据text',
];

$data = http_build_query($data);

$opts = [
    'http' => [
        'method'  => 'GET',
        // 'header'  => '',
        'header'  => "Accept: application/json, text/plain, */*" . "\r\n" . 
                     "Accept-Encoding: gzip, deflate" . "\r\n" .
                     "Accept-Language: zh-CN,zh;q=0.9" . "\r\n" .
                     "Cache-Control: no-cache" . "\r\n" .
                     "Connection: keep-alive" . "\r\n" .
                     "Cookie: laravel_token=eyJpdiI6IkFaVHAwWHE3OGtFK01UVHpvXC9QOTdBPT0iLCJ2YWx1ZSI6Imw5YTFmUEoyeUFNNVp3Vk96ODlmWDkzTUZxT1J3OG1xYWF3TjlkdEV2c0VJZ1ptUU9zYmFZeWx3aERldUZRNEdlcG83TjlybWxnV2dSTTNcL2s0clNuRTVKRERlNlRnYVBzQmN0VDc5eWs4SjZqeHNcL2t3SkpOTUxXSU14YjJ5UVpHNEV1cDBEMndMcTNFSjlRUmxIXC9KMXZMcmdmR2tvaGRXOGdLRDlTdzJxamo1Y0Q2UThVek1XOGExNTVITVRYR3NyRlkrM0NETHZDdFwvQ3FlSDhkTUhKbXBzdWtnMW5DTjJKV0lPTVJrSk8zNmFqWHdQUjg1aFZCbnoxNU9nRDh1Wnc2NVVJbjVFbWZLVmV3SWZqcTM2QT09IiwibWFjIjoiZDE2NmU0YmE5Nzg2OTcxM2EzNDVlNmM0NjUxNzM0YmY3OTk3ODllYTlhNzk4NGU1MTRmZWI1MTBmOGZlNmI2YSJ9; XSRF-TOKEN=eyJpdiI6ImFwUkZsUUhMZksxVmlCZGR4dlIxMFE9PSIsInZhbHVlIjoidlUraUE1SUE3WHBncG9yeHlyWFlxbVVISVdIQytmTHZQTXNKanVvQjRYVUh3ZHdqbWVTSkVDNWxBZkdzbGJZbCtsekw1R1FvZWZkZzI1Z2pQUUZRaXc9PSIsIm1hYyI6IjQzNWNjN2M0YzhhYWZhYjQ1NzMwMzc0MThiYzJmNTNjMWY4ZGZiZWU1ZTg4Yjc2MWQ1NGY0ZTEyMzcwNzUyOTUifQ%3D%3D; _session=eyJpdiI6Ikx3TitMdWp0T25PY1wvdU1YUldqTEV3PT0iLCJ2YWx1ZSI6Ik9NK2Y0cStFUWhJUVF4QWVIcVVjK1ZJalFoRDB4OWU0VnRHUXZpc28zdEp5SmtOYnY5YXlsaWxzbE8yV3lkYVhxSGxjd00ybmY4VkhTSFBoekxLQm9nPT0iLCJtYWMiOiIwYWJkZDEwN2QzMzQwNDFiOTA0ZDBiOWY0MzczYWQwZWFhMGIwNjk4N2Y0YjMxYTI5OWY5ODdhM2ZlODgwYzNhIn0%3D" . "\r\n" .
                     "Host: www.wdtcrmb.com" . "\r\n" .
                     "Pragma: no-cache" . "\r\n" .
                     "Referer: http://www.wdtcrmb.com/api/alter_password" . "\r\n" .
                     "Content-Type: text/html; charset=UTF-8" . "\r\n" . // "Content-type: application/x-www-form-urlencoded" . "\r\n" .
                     "Content-Length: " . strlen($data) . "\r\n" . 
                     "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3486.0 Safari/537.36" . '\r\n' .
                     "X-CSRF-TOKEN: ZCyLbgjhRT1NtvDs1ryQybsGhyDy7bZmT0f92hI4" . '\r\n' .
                     "X-Requested-With: XMLHttpRequest" . '\r\n' .
                     "X-XSRF-TOKEN: eyJpdiI6ImFwUkZsUUhMZksxVmlCZGR4dlIxMFE9PSIsInZhbHVlIjoidlUraUE1SUE3WHBncG9yeHlyWFlxbVVISVdIQytmTHZQTXNKanVvQjRYVUh3ZHdqbWVTSkVDNWxBZkdzbGJZbCtsekw1R1FvZWZkZzI1Z2pQUUZRaXc9PSIsIm1hYyI6IjQzNWNjN2M0YzhhYWZhYjQ1NzMwMzc0MThiYzJmNTNjMWY4ZGZiZWU1ZTg4Yjc2MWQ1NGY0ZTEyMzcwNzUyOTUifQ==" . '\r\n',
        "content" => $data,
    ],
];
    
$context = stream_context_create($opts);

$html = file_get_contents('http://www.wdtcrmb.com/api/alter_password', false, $context);

print_r($html);
