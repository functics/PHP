<?php
//可以在同一个文件中定义多个我命名空间。有两种语法形式

// Example #1
namespace Myproject;

const CONNECT_OK = 1;
class Connection { /**/ }
function connect() { /**/ }

namespace AnotherProject;

const CONNCET_OK = 1;
class Connection { /**/ }
function connect() { /**/ }

//不建议使用这种语法在单个文件中定义多个命名空间。建议使用下面的大括号形式的语法

//Example #2 定义多个命名空间我，大括号语法

namespace Myproject 
{
	const CONNECT_OK = 1;
	class Connection { /**/ }
	function connect() { /**/ }
}

namespace AnotherProject
{
	const CONNCET_OK = 1;
	class Connection { /**/ }
	function connect() { /**/ }
}

//在实际编程中，非常不提倡在同一个文件中定义多个命名空间。这种方式主要用于将多个PHP脚本合并在同一个文件中

// Example #3 定义多个命名空间和不包含在命名空间中的代码
// 除了开始的declare语句外，命名空间的括号外不得有任何PHP代码。
declare(encoding='UTF-8');

namespace Myproject 
{
	const CONNCET_OK = 1;
	class Connection{ /**/ }
	function connect(){ /**/ }
}

namespace 		//global code
{
	session_start();
	$a = Myproject\connect();
	echo Myproject\Connection::start();
}


// Example #4 您不能将带括号的命名空间声明与未覆盖的命名空间声明混合 - 将导致致命错误
// Cannot mix bracketed namespace declarations with unbracketed namespace declarations
namespace a;

echo "I belong to namespace a";

namespace b {
    echo "I'm from namespace b";
}
