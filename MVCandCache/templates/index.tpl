<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><!--{webname}--></title>
</head>

<body>

    系统设置了分页数为<!--{pagesize}-->

    {$name}<br />

    {$content}<br />

    {if $a}
        <div>我是一号界面</div>
    {else}
        <div>我是二号界面</div>
    {/if}

    <br />

    {#}PHP注释,静态文件看不到{#}

    <br />

    {foreach $array(key,value)}<br />
        {@key}...{@value}<br />
        {foreach $array(key,value)}<br />
            ...{@key}...{@value}<br />
        {/foreach}<br />
    {/foreach}<br />

    {include file = 'test.php'}
</body>
</html>
