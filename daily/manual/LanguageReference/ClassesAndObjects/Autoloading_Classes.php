<?php
//Autoloading is not available if using PHP in CLI interactive mode.
/***********************************************************************************************/
//This example attempts to load the classes MyClass1 and MyClass2 from the files MyClass1.php and MyClass2.php respectively.


//Autoload example
// spl_autoload_register(function ($class_name)
// {
// 	include $class_name . '.php';
// });

// $obj = new MyClass1();
// $obj = new MyClass2();

/***********************************************************************************************/
//Autoload other example

spl_autoload_register(function ($name){
	var_dump($name);
});

class Foo implements ITest{

}

// string(5) "ITest" 
// Fatal error: Interface 'ITest' not found in D:\phpStudy\WWW\PHP\manual\ClassAndObject\Autoloading_Classes.php on line 23