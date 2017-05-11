<?php
#一个 integer 是集合 ? = {..., -2, -1, 0, 1, 2, ...} 中的一个数。
#整型值可以使用十进制，十六进制，八进制或二进制表示，前面可以加上可选的符号（- 或者 +）。

#二进制表达的 integer 自 PHP 5.4.0 起可用。
#要使用二进制表达，数字前必须加上 0b。
#要使用八进制表达，数字前必须加上 0（零）。
#要使用十六进制表达，数字前必须加上 0x。

#例:
$a = 1234;          //十进制数
$a = -1234;         //负数
$a = 0123;          //八进制数(等于十进制83)
$a = 0x1A;          //十六进制(等于十进制26)
$a = 0b11111111;    //二进制(等于255)

//decimal     : [1-9][0-9]*
//            | 0
//
//hexadecimal : 0[xX][0-9a-fA-F]+
//
//octal       : 0[0-7]+
//
//binary      : 0b[01]+
//
//integer     : [+-]?decimal
//| [+-]?hexadecimal
//| [+-]?octal
//| [+-]?binary


#以上看不太明白
#Integer overflow on a 32-bit system
$large_number = 2147483647;
var_dump($large_number);                     // int(2147483647)

$large_number = 2147483648;
var_dump($large_number);                     // float(2147483648)

$million = 1000000;
$large_number =  50000 * $million;
var_dump($large_number);                     // float(50000000000)


#Integer overflow on a 64-bit system
$large_number = 9223372036854775807;
var_dump($large_number);                     // int(9223372036854775807)

$large_number = 9223372036854775808;
var_dump($large_number);                     // float(9.2233720368548E+18)

$million = 1000000;
$large_number =  50000000000000 * $million;
var_dump($large_number);                     // float(5.0E+19)
