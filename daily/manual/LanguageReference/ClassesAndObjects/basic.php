<?php 

//每个类的定义都以关键字class开头，后面跟着类名，后面跟着一对大括号，里面包含类的属性与方法的定义。
// 类名可以是任何非PHP保留字的合法标签。一个合法类名以字母或者下划线开头，后面跟着若干字母，数字或下划线。以正则表达式表示为：[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*
// 一个类可以包含有属于自己的常量，变量（称为属性）以及函数（成为方法）。

/******************************************************/

// 当一个方法在类的内部调用时，有一个可用的伪变量$this。$this 是一个到主叫对象的引用（通常是该方法所从属的对象，但如果是从第二个对象静态调用时也可能是另一个对象。）

class SimpleClass
{
	//属性声明
	public $val = 'a default value';

	//方法声明
	public function displayVar()
	{
		echo $this->var;
	}
}


/******************************************************/
class A
{
    function foo()
    {
        if (isset($this)) {
            echo '$this is defined (';
            echo get_class($this);
            echo ")\n";
        } else {
            echo "\$this is not defined.\n";
        }
    }
}

class B
{
    function bar()
    {
        A::foo();
    }
}

$a = new A();
$a->foo();

A::foo();

/******************************************************/
/*
Strict Standards: Non-static method A::foo() should not be called statically in D:\phpStudy\WWW\PHP\manual\ClassAndObject\basic.php on line 27
$this is not defined.
*/

$b = new B();
$b->bar();
/*
Deprecated: Non-static method A::foo() should not be called statically, assuming $this from incompatible context in D:\phpStudy\WWW\PHP\manual\ClassAndObject\basic.php on line 20
$this is defined (B)
*/

B::bar();

/*
Strict Standards: Non-static method B::bar() should not be called statically in D:\phpStudy\WWW\PHP\manual\ClassAndObject\basic.php on line 36

Strict Standards: Non-static method A::foo() should not be called statically in D:\phpStudy\WWW\PHP\manual\ClassAndObject\basic.php on line 20
$this is not defined.
*/

/*
Output of the above example in PHP 5:

$this is defined (A)
$this is not defined.
$this is defined (B)
$this is not defined.


Output of the above example in PHP 7:

$this is defined (A)
$this is not defined.
$this is not defined.
$this is not defined.
*/

class Test
{
    static public function getNew()
    {
        return new static;
    }
}

class Child extends Test
{}

$obj1 = new Test();
$obj2 = new $obj1;
var_dump($obj1 !== $obj2);

$obj3 = Test::getNew();
var_dump($obj3 instanceof Test);

$obj4 = Child::getNew();
var_dump($obj4 instanceof Child);



date_default_timezone_set('PRC');
echo (new DateTime())->format('Y');