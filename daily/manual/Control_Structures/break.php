<?php

$arr = array('one', 'two', 'three', 'four', 'stop', 'five');
while(list(,$val) = each($arr))
{
    if ($val == 'stop')
    {
        break;          // or here can write like this brake 1;
    }

    echo "$val<br />\n";
}


$i = 0;
while (++$i)
{
    switch ($i)
    {
        case 5:
            echo "At 5<br />\n";
            break 1;
        case 6:
            echo "At 10;quitting<br />\n";
            break 2;
        default:
            break;
    }
}


echo "*********************************************<br />";
print_r(list(,$val) = $arr);