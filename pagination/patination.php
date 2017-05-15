<?php
  header("Content-type: text/html; charset = utf-8");
  include "pagination.class.php";


  $page = new pagination(999,8);
  echo $page -> pagination(0,1,2,3,4,5,6);  //在这里设置分页的参数,即自己选择需要显示的功能,顺序可以改变,例如1,3,2,5,4,6,0
 
?>

