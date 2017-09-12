<?php

function errorHandle($errNo, $errStr, $errFile, $errLine)
{
    if (!(error_reporting() & $errNo)) {
        return false;
    }

    switch ($errNo) {
        case E_USER_ERROR://256
            echo "<b>My ERROR</b> [$errNo] $errStr<br />\n";
            echo "  Fatal error on line $errLine in file $errFile";
            echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
            echo "Aborting...<br />\n";
            exit(1);
            break;

        case E_USER_WARNING://512
            echo "<b>My WARNING</b> [$errNo] $errStr<br />\n";
            break;

        case E_USER_NOTICE://1024
            echo "<b>My NOTICE</b> [$errNo] $errStr<br />\n";
            break;

        case E_STRICT://2048
            echo "<b>My TEST</b> [$errNo] $errStr<br />\n";
            break;

        default:
            echo "Unknown error type: [$errNo] $errStr<br />\n";
            break;
    }

    /* Don't execute PHP internal error handler */
    return true;
}

// function to test the error handling
function scale_by_log($vector, $scale)
{
    if (!is_numeric($scale) || $scale <= 0) {
        trigger_error("log(x) for x <= 0 is undefined, you used: scale = $scale", E_USER_ERROR);
    }

    if (!is_array($vector)) {
        trigger_error("Incorrect input vector, array of values expected", E_USER_WARNING);
        return null;
    }

    $temp = array();
    foreach($vector as $pos => $value) {
        if (!is_numeric($value)) {
            trigger_error("Value at position $pos is not a number, using 0 (zero)", E_USER_NOTICE);
            $value = 0;
        }
        $temp[$pos] = log($scale) * $value;
    }

    return $temp;
}

// set to the user defined error handler
set_error_handler("errorHandle");

// trigger some errors, first define a mixed array with a non-numeric item
echo "vector a\n";
$a = array(2, 3, "foo", 5.5, 43.3, 21.11);
print_r($a);

// now generate second array
echo "----\n vector b - a notice (b = log(PI) * a)\n";
/* Value at position $pos is not a number, using 0 (zero) */
$b = scale_by_log($a, M_PI);
print_r($b);

// this is trouble, we pass a string instead of an array
echo "----\n vector c - a warning\n";
/* Incorrect input vector, array of values expected */
$c = scale_by_log("not array", 2.3);
var_dump($c); // NULL


echo "----\n vector d - test error\n";
$a = 1;
if ($a){
    echo $cf;
}

echo "----\n vector d - class error\n";
$mem = new memcachedd();

// this is a critical error, log of zero or negative number is undefined
echo "----\n vector d - fatal error\n";
/* log(x) for x <= 0 is undefined, you used: scale = $scale" */
$d = scale_by_log($a, -2.5);
var_dump($d); // Never reached