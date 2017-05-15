<?php
/**
 * Created by PhpStorm.
 * User: 子兴的期盼
 * Date: 2016/11/3
 * Time: 13:32
 */

/**
 * _runtime()用来获取执行耗时
 * @access public 表示函数对外公开
 * @return float 表示返回出来的是一个浮点型数字
 */
function runTime(){
    $now = explode(' ',microtime());
    return $now[1] + $now[0];
}

/**
 * 该函数表示js弹窗
 * @access public
 * @param $_info
 */
function alert_back($_info){
    echo "<script type='text/javascript'>alert('$_info');history.back();</script>";
    exit();
}

/**
 * 该函数表示js关闭窗口
 * @access public
 * @param $_info
 */
function alert_close($_info){
    echo "<script type='text/javascript'>alert('$_info');window.close();</script>";
    exit();
}

/**
 * 链接跳转
 * @param $info
 * @param $url
 * @access public
 */
function location($_info,$_url){
    echo "<script type='text/javascript'>alert('$_info');location.href='$_url';</script>";
    exit("恭喜您注册成功!");
}

/**
 * 验证码函数
 * @access puclic
 * @param string $_yzm   用户输入的验证码
 * @param string $_code  系统生成的验证码
 * return void
 */
function check_code($_yzm,$_code){
    if ($_yzm != $_code){
        alert_back('验证码不正确!');
    }
}

/**
 *code()函数用来生成验证码
 * @access public
 * @param int $width 验证码的长度
 * @param int $height 验证码的宽度
 * @param int $rand_code 验证码的随机个数
 * @param bool $onOff 边框显示开关
 * @renturn void 函数执行后产生一个验证码
 */
function code($width= 75,$height= 25, $rand_code = 4,$onOff = false){
//初始化创建随机码
    $code = "";
    for ($i=0;$i<$rand_code;$i++){
        $code .= dechex(mt_rand(0,15));
    }
    $_SESSION['code'] = $code;
//创建一张图像
    $img = imagecreatetruecolor($width,$height);
//创建画笔,白色
    $white = imagecolorallocate($img,255,255,255);
//填充到背景
    imagefill($img,0,0,$white);
//定义验证码边框
//边框开关
    if ($onOff){
        //创建黑色边框
        $black = imagecolorallocate($img,0,0,0);
        imagerectangle($img,0,0,$width-1,$height-1,$black);
    }

//随机画出6个线条
    $rand_color = "";
    for ($i=0;$i<6;$i++){
        $rand_color = imagecolorallocate($img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
        imageline($img,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),$rand_color);
    }
//随机雪花

    for ($i=0;$i<100;$i++){
        imagestring($img,1,mt_rand(1,$width),mt_rand(1,$height),'*',$rand_color);
    }
//输出验证码
    for ($i=0;$i<strlen($_SESSION['code']);$i++){
        imagestring($img,5,$i*$width/$rand_code+mt_rand(1,10),mt_rand(1,$height/2),$_SESSION['code'][$i],
            imagecolorallocate($img,mt_rand(0,100),mt_rand(0,150),mt_rand(0,200)));
    }

//输出图片
    header('Content-Type:image/png');
    imagepng($img);
//销毁
    imagedestroy($img);
}

/**
 * 登录状态的判断
 */
//初始化
$_COOKIE['username'] = isset($_COOKIE['username']) ? $_COOKIE['username'] : "";
function login_state(){
    if ($_COOKIE['username']){
        alert_back("登录状态无法进行此操作!");
    }
}

/**
 * 标题截取函数
 * @param $string
 * @return string
 */
function title($string,$min=14){
    if (mb_strlen($string,'utf-8') > $min){
        $string = mb_substr($string,0,$min,'utf-8').'...';
    }
    return $string;
}

/**
 * 生成XML文件
 * @param $XMLfile
 * @param $clean
 */
function create_XML($XMLfile,$clean){
    $fp = @fopen("new.xml","w");
    if (!$fp){
        exit("系统错误,文件不存在!");
    }
    //锁定
    flock($fp,LOCK_EX);

    $_word = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\r\n";
    fwrite($fp,$_word,strlen($_word));
    $_word = "<vip>\r\n";
    fwrite($fp,$_word,strlen($_word));
    $_word = "\t<id>{$clean['id']}</id>\r\n";
    fwrite($fp,$_word,strlen($_word));
    $_word = "\t<username>{$clean['username']}</username>\r\n";
    fwrite($fp,$_word,strlen($_word));
    $_word = "\t<sex>{$clean['sex']}</sex>\r\n";
    fwrite($fp,$_word,strlen($_word));
    $_word = "\t<face>{$clean['face']}</face>\r\n";
    fwrite($fp,$_word,strlen($_word));
    $_word = "\t<email>{$clean['email']}</email>\r\n";
    fwrite($fp,$_word,strlen($_word));
    $_word = "\t<url>{$clean['url']}</url>\r\n";
    fwrite($fp,$_word,strlen($_word));
    $_word = "</vip>";
    fwrite($fp,$_word,strlen($_word));

    //解锁
    flock($fp,LOCK_UN);
    fclose($fp);
}

function get_XML($xmlfile){
    $xml_arr = array();
    if (file_exists($xmlfile)){
        $xml = file_get_contents("$xmlfile");
        preg_match_all('/<vip>(.*)<\/vip>/s', $xml, $dom);
        foreach ($dom[1] as $value){
            preg_match_all('/<id>(.*)<\/id>/s', $value, $id);
            preg_match_all('/<username>(.*)<\/username>/s', $value, $username);
            preg_match_all('/<sex>(.*)<\/sex>/s', $value, $sex);
            preg_match_all('/<face>(.*)<\/face>/s', $value, $face);
            preg_match_all('/<email>(.*)<\/email>/s', $value, $email);
            preg_match_all('/<url>(.*)<\/url>/s', $value, $url);
            $xml_arr['id'] = $id[1][0];
            $xml_arr['username'] = $username[1][0];
            $xml_arr['sex'] = $sex[1][0];
            $xml_arr['face'] = $face[1][0];
            $xml_arr['email'] = $email[1][0];
            $xml_arr['url'] = $url[1][0];
        }
    }else{
        echo "文件不存在!";
    }
    return $xml_arr;
}

function ubb($string){
    //转换字体大小
    $string = preg_replace('/\[size\=(.*)](.*)\[\/size\]/U','<span style="font-size:\1px">\2</span>',$string);
    //转换换行
    $string = nl2br($string);
    //转换粗体
    $string = preg_replace('/\[b\](.*)\[\/b\]/U','<strong>\1</strong>',$string);
    //转换斜体
    $string = preg_replace('/\[i\](.*)\[\/i\]/U','<em>\1</em>',$string);
    //转换下划线
    $string = preg_replace('/\[u\](.*)\[\/u\]/U','<span style="text-decoration:underline">\1</span>',$string);
    //转换删除线
    $string = preg_replace('/\[s\](.*)\[\/s\]/U','<span style="text-decoration:line-through">\1</span>',$string);
    //转换颜色
    $string = preg_replace('/\[color=(.*)\](.*)\[\/color\]/U','<span style="color:\1">\2</span>',$string);
    //转换url
    $string = preg_replace('/\[url\](.*)\[\/url\]/U','<a href="\1" target="_blank" >\1</a>',$string);
    //转换email
    $string = preg_replace('/\[email\](.*)\[\/email\]/U','<a href="mailto:\1" target="_blank" >\1</a>',$string);
    //转换图片
    $string = preg_replace('/\[img\](.*)\[\/img\]/U','<img src="\1" alt="图片" />',$string);
    //转换flash
    $string = preg_replace('/\[flash\](.*)\[\/flash\]/U','<embed style="width:480px;height:400px;" src="\1" />',$string);
    return $string;
}

