<?php
// 1.使用composer自动加载器
require 'vendor/autoload.php';

// 2.实例 Guzzle HTTP 客户端
$client = new \GuzzleHttp\client();

// 3.打开并迭代处理CSV
$csv = \League\Csv\Reader::createFromPath('./urls.csv', 'r');
foreach ($csv as $csvRow) {
	try {
		// 4. 发送HTTP OPTIONS请求
		$httpResponse = $client->options($csvRow[0]);

		// 5.检查HTTP响应的状态码
		if ($httpResponse->getStatusCode() >= 400) {
			throw new \Exception();
		}
	} catch (\Exception $e) {
		// 6. 把死链发给标准输出
		echo $csvRow[0] . PHP_EOL;
	}
}