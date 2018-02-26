<?php
/*
The declare construct is used to set execution directives for a block of code. The syntax of declare is similar to the syntax of other flow control constructs:

declare (directive)
    statement

*/

/*

//this is valid:
declare(ticks=1);


//this is invalid:
const TICK_VALUE = 1;
declare(ticks = TICK_VALUE);


//can use like this :
declare(ticks = 1){
	// code...
}

//or like this:
declare(ticks = 1);
	//code...

*/
/***********************************************************************************/
// declare(ticks = 1);

// //a function called on each tick even;
// function tick_hander()
// {
// 	echo "tick_hander() called <br />\n";
// }

// register_tick_function('tick_hander');  //第一次输出

// $a = 1;

// if ($a > 0)
// {
// 	$a += 2;
// 	print($a);
// }
/***********************************************************************************/ 
/*tick事件在PHP每执行N条低级语句就发生一次，N由declare语句指定。*/
function doTicks ()
{
    echo 'Ticks';
}
register_tick_function('doTicks');
declare(ticks = 1) {
    for ($x = 1; $x < 10; ++ $x) {
        echo $x * $x . '<br />';
    }
}