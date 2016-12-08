<?php
print_r($_FILES);
echo "<br />";

define('URL', dirname(__FILE__).'\uploads');
// echo URL;
echo "<br />";

//判断给定的目录是否存在
if (!is_dir(URL)) {
    mkdir(URL, 0777);///0777表示最大权限   默认是0700
}

if (@is_uploaded_file($_FILES['userfile']['tmp_name'])) {
    //在这里移动文件
    if(move_uploaded_file($_FILES['userfile']['tmp_name'], URL.'/'.$_FILES['userfile']['name'])){
        echo "上传成功!";
    }else{
        echo "上传失败!";
    }
 }else{
    echo "找不到上传文件!";
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
</head>

<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
        上传文件:<input type="file" name="userfile" />
        <input type="submit" name="tj_button" value="提交">
    </form>
</body>
</html>
