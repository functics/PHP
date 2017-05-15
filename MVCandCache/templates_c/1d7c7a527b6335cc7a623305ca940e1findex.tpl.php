<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php echo $this->config['webname']; ?></title>
</head>

<body>

    系统设置了分页数为<?php echo $this->config['pagesize']; ?>

    <?php echo $this->vars['name']; ?><br />

    <?php echo $this->vars['content']; ?><br />

    <?php if ($this->vars['a']){ ?>
        <div>我是一号界面</div>
    <?php } else { ?>
        <div>我是二号界面</div>
    <?php } ?>

    <br />

    <?php /* PHP注释,静态文件看不到 */ ?>

    <br />

    <?php foreach($this->vars['array'] as $key => $value){ ?><br />
        <?php echo $key;?>...<?php echo $value;?><br />
        <?php foreach($this->vars['array'] as $key => $value){ ?><br />
            ...<?php echo $key;?>...<?php echo $value;?><br />
        <?php } ?><br />
    <?php } ?><br />

    <?php include 'test.php';?>
</body>
</html>
