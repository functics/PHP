<?php

$str = "www.wdt.com";
#*****************************************************************************************
#字符串转数组

#explode():

$str_arr = explode('.', $str);		
print_r($str_arr);								#Array ( [0] => www [1] => wdt [2] => com )
echo "<br />";
#*****************************************************************************************
#数组转字符串	

#impode():   

$arr_str = implode(".", $str_arr);
echo($arr_str)."<br />";						#www.wdt.com
// echo($arr_str)."\r\n";	

# join(): join()是impolde()的别名

$join = join(".", $str_arr);
echo $arr_str."<br />";							#www.wdt.com				


#*****************************************************************************************
#字符串截取		substr()  |||| 	mb_substr(str, start)	|||   mb_strcut(str, start)


$sub_str = substr($str, 3);							#.wdt.com
echo $sub_str."<br />";



#*****************************************************************************************
#字符串替换		preg_replace()   str_replace(search, replace, subject)

$preg_re = preg_replace("/(\.)+/", ",", $str);
echo $preg_re."<br />";										#www,wdt,com

#*****************************************************************************************
#字符串查找		preg_match()	||| preg_match_all()   |||    strstr() |||		preg_grep()

$preg_ma = preg_match("/(\.)/", $str);
echo $preg_ma."<br />";												#1

#*****************************************************************************************
#写出下列代码的数据结果:

$date =  "08/26/2003"; #   ------>    "2003/08/26"

#1:
$date_1 = explode("/", $date);
$res = $date_1[2]."/".$date_1[0]."/".$date_1[1];
echo $res."<br />"; #2003/08/26  尽管不是万能 

#2:
$res = preg_replace("/(\d+)\/(\d+)\/(\d+)/", '$3/$1/$2', $date);
echo $res."<br />"; #2003/08/26  方法不错,对比上边的话其实一样,效率还没判断

#3:
$a = "$date[6]$date[7]$date[8]$date[9]/$date[0]$date[1]/$date[3]$date[4]";
echo $a."<br />";
#看见这个代码的时候差点笑哭....,可以实现 没错

#*****************************************************************************************
#写一个函数,尽可能高效的,从一个标准url里取出文件的扩展名(如下,取出php或者.php)

$url = "http://www.test.com.cn/abc/de/fg.php";
#$url = "http://www.test.com.cn/abc/de/fg.php?id=10";如果是这种先用parse_url(),[path]再用pathinfo();
// print_r(parse_url($url));#Array ( [scheme] => http [host] => www.test.com.cn [path] => /abc/de/fg.php [query] => id=10 )


#取php
#(1):
$res = explode(".", $url)[4];
echo $res."<br />";	#php

#(2):
$res = preg_match_all("/php/", $url, $match);
echo $match[0][0]."<br />";	#php

#(3)
$res = substr($url, -3);
echo $res."<br />";#php

#(4)尽可能高效的
$res = pathinfo($url);
// print_r($res);	#Array ( [dirname] => http://www.test.com.cn/abc/de [basename] => fg.php [extension] => php [filename] => fg )
echo $res['extension'];#php


#取.php
#(1):
$res = preg_match_all("/\.php/", $url, $match);
echo $match[0][0]."<br />";	#.php

#(2):
$res = substr($url, -4);
echo $res."<br />";#.php

