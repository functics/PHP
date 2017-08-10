<?php
/*
// ** Parent constructors are not called implicitly if the child class defines a constructor. **
Class BaseClass
{
	public function __construct ()
	{
		print "In BaseClass constructor\n";
	}
}

Class subClass extends BaseClass
{
	public function __construct()
	{
		parent::__construct();
		print "In Subclass constructor\n";
	}
}

Class OtherSubClass extends BaseClass
{
	//inherits BaseClass's constructor
}

//In BaseClass constructor
$obj = new BaseClass();
echo PHP_EOL;


//In BaseClass constructor
//In SubClass constructor
$obj = new SubClass();
echo PHP_EOL;


//In BaseClass constructor
$obj = new OtherSubClass();

// As of PHP 5.3.3, methods with the same name as the last element of a namespaced class name will no longer be treated as constructor. This change doesn't affect non-namespaced classes.
// 从PHP 5.3.3开始，与命名空间的类名称的最后一个元素具有相同名称的方法将不再被视为构造函数。 此更改不会影响非命名空间的类。

// namespace Foo;
// class Bar {
//     public function Bar() {
//         // treated as constructor in PHP 5.3.0-5.3.2
//         // treated as regular method as of PHP 5.3.3
//     }
// }


*/
/*********************************************************************************************************/
/***********************************************Destructor************************************************/
// void __destruct ( void )
/*
class MyDestructableClass{
	public function __construct()
	{
		print "In constructor\n";
		$this->name = "MyDestructableClass";
		// exit();
		// die();   //die() method also can do this 
	}

	public function __destruct()
	{
		print "Destroying ".$this->name . "\n";
	}
}

$obj = new MyDestructableClass();
*/
// The destructor will be called even if script execution is stopped using exit(). Calling exit() in a destructor will prevent the remaining shutdown routines from executing.

/****************************************************************************************************/
class Action
{
    public function __construct()
    {
        if(method_exists($this,'hello'))
        {
        	print_r($this);        //IndexAction Object ( )
            $this -> hello();
        }
        echo 'hello Action';
    }
}

class IndexAction extends Action
{
    public function hello()
    {
        echo 'hello IndexAction';
    }
}

// $obj = new Action();    	//hello Action

$obj = new IndexAction();	//hello IndexAction   hello Action