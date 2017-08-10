<?php 
// (PHP 5 >= 5.3.0, PHP 7)
/*

什么是命名空间，最广泛的定义就是 *******命名空间是封装项目的方法*********

在PHP世界中，命名空间旨在解决库和应用程序作者在创建可重用的代码元素（如类或函数）时遇到的两个问题：

1.命名您创建的代码与内部PHP类/函数/常量或第三方类/函数/常量之间的冲突。
2.别名（或缩短）Extra_Long_Names旨在缓解第一个问题，提高源代码的可读性。

*/

/*****************************************/
namespace my\name;

class MyClass{}
function myfunction (){}
const MYCONST = 1;

$a = new MyClass;

print_r($a);     			//my\name\MyClass Object( )
echo PHP_EOL;

$c = new \my\name\MyClass;

print_r($c);				//my\name\MyClass Object( )
echo PHP_EOL;	

$a = strlen('hi');			

var_dump($a);				//int(2)
echo PHP_EOL;

$d = namespace\MYCONST;

var_dump($d);				//int(1)
echo PHP_EOL;

$d = __NAMESPACE__.'\MYCONST';

echo constant($d);  		//1
echo PHP_EOL;

$b = my\name\MYCONST;

var_dump($b);//Fatal error: Undefined constant 'my\name\my\name\MYCONST' in D:\phpStudy\WWW\PHP\manual\LanguageReference\NamespacesOverview.php on line 46
echo PHP_EOL;

//BUT
$b = \my\name\MYCONST;		
var_dump($b);			 	//int(1)

/*****************************************/