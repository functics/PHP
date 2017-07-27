<?php
// Defining and using a constant
class myClass
{
    const CONSTANT = "constant value";

    public function showConstant()
    {
        echo self::CONSTANT. "\n";
    }
}

echo myClass::CONSTANT . "<br />";

$className = "myClass";
echo $className::CONSTANT . "<br />";    //php 5.3.0

$class = new myClass();
$class->showConstant();
echo '<br />';

echo $class::CONSTANT . "<br />";      //php 5.3.0

/********************************************************/
//Static data example
class foo{
	//As for PHP 5.3.0
	const BAR = <<<'EOT'
bar
EOT;

	//As for PHP 5.3.0
	const BAZ = <<<EOT
baz
EOT;
}

/********************************************************/
//Namespaced ::class example
namespace foo{
	class bar{
	}

	echo bar::class;   // foo\bar
}
/********************************************************/
//Constant expression example
const ONE = 1;

class foo{
	//as for php5.6.0
	const TWO = ONE * 2;  //2
	const THREE = ONE + self::TWO;    //3
	const SENTENCE = 'the value of THREE is '.self::THREE;   //3
}