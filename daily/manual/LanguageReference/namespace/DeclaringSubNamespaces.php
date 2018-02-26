<?php 

// Much like directories and files, PHP namespaces also contain the ability to specify a hierarchy of namespace names. Thus, a namespace name can be defined with sub-levels:

//跟目录或者文件很相似，PHP命名空间也包含指定指定命名空间名称层次结构的功能。因此，可以使用子级别定义命名空间名称

namespace MyProject\Sub\level;

const CONNECT_OK = 1;
class Connection { /*...*/ }
function connect(){	/*...*/	}


// 以上示例创建常量	MyProject\Sub\Level\CONNECT_OK，
// MyProject类，
// Sub\Level\Connection类
// 和MyProject\Sub\Level\connect类。