<?php 
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