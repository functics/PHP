<?php

/***************************************************************************/
// Example #1 Declaring a single namespace


// Although any valid PHP code can be contained within a namespace, only the following types of code are affected by namespaces: classes (including abstracts and traits), interfaces, functions and constants.

// Namespaces are declared using the namespace keyword. A file containing a namespace must declare the namespace at the top of the file before any other code - with one exception: the declare keyword.


namespace MyProject;

const CONNECT_OK = 1;
class Connection{}

function connect(){}


/***************************************************************************/
// Example #2 Declaring a single namespace

// The only code construct allowed before a namespace declaration is the declare statement, for defining encoding of a source file. In addition, no non-PHP code may precede a namespace declaration, including extra whitespace:

// <html>
// <?php
// namespace MyProject; // fatal error - namespace must be the first statement in the script


/***********************************************************************************/
// NOTE 1: 

//即使第一句话就是  namespace NS; 依旧报错，可能是UTF-8的BOM格式    尝试转换为无BOM格式

// NOTE 2:
namespace NS;

define(__NAMESPACE__.'\foo', '111');
define('foo', '222');
echo __NAMESPACE__.PHP_EOL;	//NS
echo foo.PHP_EOL;			//111
echo \foo.PHP_EOL;			//222
echo \NS\foo.PHP_EOL;		//111
echo NS\foo; 				//Fatal error: Undefined constant 'NS\NS\foo'