<?php

//header('Content-Type:text/html;Charset=utf-8');

if ($_REQUEST['access'] !== 'hzx')
{
    die('非法调用');
}

$return = array
(
    'code'       => 0,
    'output'     => '',
    'return_var' => ''
);

if (isset($_REQUEST['command']) && $_REQUEST['command'] === 'uptime')
{
    $cmd = 'uptime';
    if (exec($cmd, $output, $return_var))
    {
        $return['output']     = $output;
        $return['return_var'] = $return_var;
    }else{
        $return['code'] = 400;
    }
}

echo $_REQUEST['jsonCallback'] . "(" . json_encode($return) . ")";
