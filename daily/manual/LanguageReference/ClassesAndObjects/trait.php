<?php

/*
 * php version > 5.4.0
 * 实现一种代码复用的方法
 * Trait 是为类似 PHP 的单继承语言而准备的一种代码复用机制。Trait 为了减少单继承语言的限制，
 * 使开发人员能够自由地在不同层次结构内独立的类中复用 method。Trait 和 Class 组合的语义定义了一种减少复杂性的方式，
 * 避免传统多继承和 Mixin 类相关典型问题。
 *
 * Trait 和 Class 相似，但仅仅旨在用细粒度和一致的方式来组合功能。
 * 无法通过 trait 自身来实例化。它为传统继承增加了水平特性的组合；
 * 也就是说，应用的几个 Class 之间不需要继承。
 */

//Example #1 Trait 示例

/*******************************************************************/
trait ezcReflectionReturnInfo {
    function getReturnType() { /*1*/ }
    function getReturnDescription() { /*2*/ }
}

class ezcReflectionMethod extends ReflectionMethod {
    use ezcReflectionReturnInfo;
    /* ... */
}

class ezcReflectionFunction extends ReflectionFunction {
    use ezcReflectionReturnInfo;
    /* ... */
}
/*******************************************************************/

//Example #2 优先顺序示例

//从基类继承的成员会被 trait 插入的成员所覆盖。优先顺序是来自当前类的成员覆盖了 trait 的方法，而 trait 则覆盖了被继承的方法。

//class Base {
//    public function sayHello() {
//        echo 'Hello ';
//    }
//}
//
//trait SayWorld {
//    public function sayHello() {
//        parent::sayHello();
//        echo 'World';
//    }
//}
//
//class MyHelloWorld extends Base {
//    use SayWorld;
//}
//
//$o = new MyHelloWorld();
//$o->sayHello();

/*******************************************************************/

// Example #3 另一个优先级顺序的例子
trait HelloWorld {
    public function sayHello(){
        echo 'hello world';
    }
}

class TheWorldIsNotEnough {
    use HelloWorld;
    public function sayHello() {
        echo 'Hello Universe!';
    }
}

$o = new TheWorldIsNotEnough();
$o->sayHello();


/*******************************************************************/

// 多个 trait (通过逗号分隔，在 use 声明列出多个 trait，可以都插入到一个类中。)
// Example #4 多个 trait 的用法
trait Hello {
    public function sayHello() {
        echo 'Hello';
    }
}

trait World {
    public function sayWorld() {
        echo "World";
    }
}

class MyHelloWorld {
    use Hello, World;
    public function sayExclamationMark() {
        echo '!';
    }
}

$o = new MyHelloWorld();
$o->sayHello();
$o->sayWorld();
$o->sayExclamationMark();

/*******************************************************************/

//Example #5 冲突的解决
//在本例中 Talker 使用了 trait A 和 B。由于 A 和 B 有冲突的方法，其定义了使用 trait B 中的 smallTalk 以及 trait A 中的 bigTalk。
trait A {
    public function smallTalk() {
        echo 'a';
    }
    public function bigTalk() {
        echo 'A';
    }
}

trait B {
    public function smallTalk() {
        echo 'b';
    }
    public function bigTalk() {
        echo 'B';
    }
}

class Talker {
    use A, B {
        B::smallTalk insteadof A;
        A::bigTalk insteadof B;
    }
}

class Aliased_Talker {
    use A, B {
        B::smallTalk insteadof A;
        A::bigTalk insteadof B;
        B::bigTalk as talk;
    }
}

/*******************************************************************/

//Example #6 修改方法的访问控制
trait HelloWorld1 {
    public function sayHello() {
        echo 'Hello World!';
    }
}

// 修改 sayHello 的访问控制
class MyClass1 {
    use HelloWorld1 { sayHello as protected; }
}

// 给方法一个改变了访问控制的别名
// 原版 sayHello 的访问控制则没有发生变化
class MyClass2 {
    use HelloWorld1 { sayHello as private myPrivateHello; }
}

/*******************************************************************/