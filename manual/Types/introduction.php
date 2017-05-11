<?php
#php支持9种原始数据类型
#其中包括四种标量类型,三种复合类型,两种特殊类型


#四种标量类型
#1.boolean  布尔类型                    支持
#2.integer  整型　　                    支持
#3.float    浮点型(也称作double)　   　　 支持
#4.string   字符串　                    支持

#四种复合类型
#1.array    数组                       支持
#2.object   对象                       支持
#3.callback 回调类型(也成做callable可调用)支持    在这有争议!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
#4.iterable 可迭代                     不支持

#两种特殊类型
#1.resource 资源类型 　                 支持
#2.NULL     空　　      　   　         支持


/***************************************************************************/

#一些伪类型
#1.mixed                                混合类型
#2.number                               数字
#3.callback (callable)
#4.array|object
#5.void
#和伪变量$,可能还会读到一些关于"双精度（double）"类型的参考。实际上 double 和 float 是相同的，由于一些历史的原因，这两个名称同时存在。
###变量的类型通常不是由程序员设定的，确切地说，是由 PHP 根据该变量使用的上下文在运行时决定的。 ###

#note如果想查看某个表达式的值和类型，用 var_dump() 函数。
#如果只是想得到一个易读懂的类型的表达方式用于调试，用 gettype() 函数。要查看某个类型，不要用 gettype()，而用 is_type 函数。以下是一些范例：

$a_bool = TRUE;
$a_str  = "foo";
$a_str2 = "foo";
$an_int = 12;

echo gettype($a_bool)."<br />";
echo gettype($a_str)."<br />";
echo gettype($a_bool)."<br />";
echo gettype($a_bool)."<br />";

if (is_int($an_int)) {
    $an_int += 4;
}

echo $an_int;

if (is_string($a_bool)) {
    echo "String: $a_bool";
}

#如果要将一个变量强制转换为某类型，可以对其使用强制转换或者 settype() 函数。



