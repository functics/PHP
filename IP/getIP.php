<?php

//function 1

function get_real_ip(){
    $ip = FALSE;

    if (!empty($_SERVER["HTTP_CLIENT_IP"]))
    {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }

    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
        $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
        if ($ip)
        {
            array_unshift($ips, $ip);
            $ip = FALSE;
        }
        for ($i = 0; $i < count($ips); $i++)
        {
            if (!eregi ("^(10|172\.16|192\.168)\.", $ips[$i]))
            {
                $ip = $ips[$i];
                break;
            }
        }
    }
    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
}

//echo get_real_ip();

//function 2
function getIP()
{
    if (@$_SERVER["HTTP_X_FORWARDED_FOR"])
    {
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }else if (@$_SERVER["HTTP_CLIENT_IP"]) {
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }else if ($_SERVER["REMOTE_ADDR"]) {
        $ip = $_SERVER["REMOTE_ADDR"];
    }else if (getenv("HTTP_X_FORWARDED_FOR")) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    }else if (getenv("HTTP_CLIENT_IP")) {
        $ip = getenv("HTTP_CLIENT_IP");
    }else if (getenv("REMOTE_ADDR")) {
        $ip = getenv("REMOTE_ADDR");
    }else {
        $ip = "Unknown";
    }
    return $ip;
}

echo getip();