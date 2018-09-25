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
        'header'  => '',
        // 'header'  => "Accept: application/json, text/plain, */*" . "\r\n" . 
                    //  "Accept-Encoding: gzip, deflate" . "\r\n" .
                    //  "Accept-Language: zh-CN,zh;q=0.9" . "\r\n" .
                    //  "Cache-Control: no-cache" . "\r\n" .
                    //  "Connection: keep-alive" . "\r\n" .
                    //  "Cookie: laravel_token=eyJpdiI6IkJlU3U0R1RUUFRoVEhEbEVKUFh0VVE9PSIsInZhbHVlIjoiVCtpNUtIeHZDT2w1aWFPeUNFdk8wTDFYaFdlVmFyXC9LdzhKcHpTYWZnS08xWTFsN0lzZitROGg4Q2VXRTVFWmU3YzkzY1JuQXpMZmNhTTQyYXpUeEpObWF3bkZ3eHl6MGE1SnZrK1BWemFFa3RnRUVMRjh1RnhsYlwvaExta2dcLzJXZ0JcL0I1WnBSRUtuV0NCWktWY21IazVQZ0k1c3V0anBIXC9CRVlwbjB4K1J6bWo4SGFxVmlaSm9oZ1pZRFh3bnNSRVlqYlhSckczUXA0S0FaaHJLbk5CM3lDTGZSSGcrQXIrRkJ3TkZXQXlSMERPWFBIdDlxTXZERmsxQzcyRnRXWW9ZMnJ0VDJZTW0rd1wvM2xJRW1vUXc9PSIsIm1hYyI6ImJhY2U3NWE3OTllMjg1MThjOTliYzk4OTdlODA1ZjcxYjA5MzM2MGFhOGQzNjAxYmQzMGU1ZmY4NDQ1YWViMDEifQ%3D%3D; XSRF-TOKEN=eyJpdiI6IlFDUlNQSGFBNnpkWkdmbXI1dkFVRlE9PSIsInZhbHVlIjoiVHJoZXAreThWQm85QkpNWkp1cENjamlqdG5TaUp2V0pqYkw2NEcrcHpuWXpsMlJUdDArRlwvWGFpRDRMckhJR1hYSVFrcUVJaWdPV2N0NldXUGhcL1Y2UT09IiwibWFjIjoiMGRlZDYwM2M4OGMwMzhmZDZkY2UyMTVmNzlhYzRjMDE5YTA3YTVmOTMyNzQxY2E2OTM4OWFiMjIxNzM5MjExYyJ9; _session=eyJpdiI6IkZEWGdYN3l3dEFsUDZnalFlbm1kcFE9PSIsInZhbHVlIjoibnp4MkRoS1Y4NlVEa1ZrbXp5VUViMzNpTG1paDc1WEtZWCtucmE1bnhET1wvRlwveGlYdWNjNUVZbjBpb21NTW1JXC94MUZXMWxKSXpuMEt0bDBXRXpDdVE9PSIsIm1hYyI6Ijk3Mzg2NzEzMjJmNDhhODAxNGU1ZTJhODQzNGRmY2YxMzRlYjY3YWEzNmM4M2YzYTFiYTIxZjQ4N2U2ZjYxNjMifQ%3D%3D" . "\r\n" .
                    //  "Host: www.wdtcrmb.com" . "\r\n" .
                    //  "Pragma: no-cache" . "\r\n" .
                    //  "Referer: http://www.wdtcrmb.com/api/alter_password" . "\r\n" .
                    //  "Content-Type: text/html; charset=UTF-8" . "\r\n" . // "Content-type: application/x-www-form-urlencoded" . "\r\n" .
                    //  "Content-Length: " . strlen($data) . "\r\n" . 
                    //  "User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3486.0 Safari/537.36" . '\r\n' .
                    //  "X-CSRF-TOKEN: qNIGhqnp6p30QOePcEVf8KrUXuDGJJBkpsscs04j" . '\r\n' .
                    //  "X-Requested-With: XMLHttpRequest" . '\r\n' .
                    //  "X-XSRF-TOKEN: eyJpdiI6IlFDUlNQSGFBNnpkWkdmbXI1dkFVRlE9PSIsInZhbHVlIjoiVHJoZXAreThWQm85QkpNWkp1cENjamlqdG5TaUp2V0pqYkw2NEcrcHpuWXpsMlJUdDArRlwvWGFpRDRMckhJR1hYSVFrcUVJaWdPV2N0NldXUGhcL1Y2UT09IiwibWFjIjoiMGRlZDYwM2M4OGMwMzhmZDZkY2UyMTVmNzlhYzRjMDE5YTA3YTVmOTMyNzQxY2E2OTM4OWFiMjIxNzM5MjExYyJ9" . '\r\n',
        "content" => $data,
    ],
];
    
$context = stream_context_create($opts);

$html = file_get_contents('http://www.wdtcrmb.com/api/alter_password', false, $context);
// $html = file_get_contents('http://www.wdtcrmb.com/api/alter_password', false, $context);

print_r($html);
