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
