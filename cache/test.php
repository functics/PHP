<?php

// phpinfo();
$mem = new Memcache;					//实例化对象
$mem->connect("localhost", 11211);		//连接服务器(ip,poort)   持久连接为pconnect
// $mem->addServer("域名/ip", 11221);	//如果为多个服务器

$mem->add("my_str", "this is a memcache test", MEMCACHE_COMPRESSED, 3600);

// $mem->add("my_str", "this is a memcache test2", MEMCACHE_COMPRESSED, 3600);
//这样写会报错,add()方法不会覆盖,需要替换使用set()或者replace()方法

$mem->set("my_str", "this is a memcache test2", MEMCACHE_COMPRESSED, 3600);

//删除测试
$mem->delete("my_str");  

//存数组
$mem->add("my_arr", array("aaa", "bbb", "ccc", 111, "111"), MEMCACHE_COMPRESSED, 3600);

//存对象

class person{
	public $name = "张三";
	public $age = 43;
}

$mem->add("my_obj", new person, MEMCACHE_COMPRESSED, 3600);

//删除所有变量
$mem->flush();

$str = $mem->get("my_str");
$arr = $mem->get("my_arr");
$obj = $mem->get("my_obj");





echo "string: ".$str."<br />";
print_r($arr);
echo "<br />";
var_dump($obj);
// print_r($obj);
echo "<br />";
echo $mem->getVersion();			//获取当前版本  1.4.4-14-g9c660c0
echo "<br />";

echo "<pre>";

print_r($mem->getStats());

echo "</pre>";




$mem->close();							//断开连接


//什么时候使用memcache

// 1.数据库读出数据时 用memcache处理;
// 2.在会话控制session中使用;