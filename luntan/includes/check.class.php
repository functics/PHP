<?php
/**
 * Created by PhpStorm.
 * User: 子兴的期盼
 * Date: 2016/11/6
 * Time: 17:11
 */
//防止恶意调用
if (!defined('IN_GT')){
    exit('Access Denied!');
}

/**
 * 用户名验证函数
 * @access public
 * @param string $_string 受污染的用户名
 * @param int $_min_num 最小位数
 * @param int $_max_num 最大位数
 * @return string 过滤后的用户名
 */
function check_username($_string,$_min_num=2,$_max_num=20){
    global $system_set;
    //去掉两边的空格
    $_string = trim($_string);
    //长度小于2位大于20位
    if (mb_strlen($_string,'utf-8') < $_min_num || mb_strlen($_string,'utf-8') > $_max_num){
        alert_back('长度不得小于'.$_min_num.'位大于'.$_max_num.'位');
    }
    //限制敏感字符
    $_char_pattern = '/[<>\'\"\ ]/';     //桉顺序限制 < > ' " \ 英文空格 中文空格
    if (preg_match($_char_pattern,$_string)){
        alert_back('用户名不能包含敏感字符!');
    }
    //限制敏感用户名
//    $_mg[0] = '何佳宁';
//    $_mg[1] = '何子兴';
//    $_mg[2] = '华欣';
//    $_mg[3] = '阳照';
//    $_mg[4] = '邹信';
    $_mg = explode("|",$system_set['string']);
    /*//告诉用户哪些不能用
    $_mg_string = '';
    foreach($_mg as $value){
        $_mg_string .= $value.'\n';
    }
    */
    //采用绝对匹配
    if (in_array($_string,$_mg)){
        alert_back('敏感用户名不能注册');
    }
    return $_string;
}

/**
 * 验证密码函数
 * @access public
 * @param string $_first_pass 密码
 * @param string $_end_Pass  重复密码
 * @param int $_min_num  最小位数
 * @return string  返回sha1加密后的密码
 */
function check_password($_first_pass,$_end_Pass,$_min_num){
    //判断密码
    if (strlen($_first_pass) < $_min_num){
        alert_back('密码不得小于'.$_min_num.'位!');
    }
    //密码确认一致
    if (!($_first_pass == $_end_Pass)){
        alert_back('两次密码输入不一样,请重新输入!');
    }
    //将密码返回
    return sha1($_first_pass);
}

/**
 * 密码提示问题函数
 * @access public
 * @param string $_question  密码提示问题
 * @param int $_min_num   最小位数
 * @param int $_max_num  最大位数
 * @return string  防止sql注入的返回值
 */
function check_question($_question,$_min_num=4,$_max_num=20){
    $_question = trim($_question);
    //长度小于4位大于20位过滤掉
    if (mb_strlen($_question,'utf-8') < $_min_num || mb_strlen($_question,'utf-8') > $_max_num){
        alert_back('密码提示长度不得小于'.$_min_num.'位大于'.$_max_num.'位');
    }
    return $_question;
}

/**
 * 密码回答函数
 * @access public
 * @param string $_question  密码提示
 * @param string $_answer    密码回答
 * @param int $_min_num      最小位数
 * @param int $_max_num      最大位数
 * @return string            返回sha1加密后的密码回答
 */
function check_answer($_question,$_answer,$_min_num=2,$_max_num=20){
    $_answer = trim($_answer);
    //长度小于4位大于20位过滤掉
    if (mb_strlen($_answer,'utf-8') < $_min_num || mb_strlen($_answer,'utf-8') > $_max_num){
        alert_back('密码回答长度不得小于'.$_min_num.'位大于'.$_max_num.'位');
    }
    //密码提示和密码回答不能一致
    if ($_answer == $_question){
        alert_back('密码提示和密码回答不能一样!');
    }
    return sha1($_answer);
}

/**
 * 电子邮件过滤函数
 * @access public
 * @param string $email   邮件地址
 * @return string $email  返回验证后的邮箱
 */
function check_email($email,$_min_num=6,$_max_num=40){
    //参考XXXX@XX.com.net.cn
    //任意字符表示方法[a-zA-Z0-9_]=>\w
    if (!preg_match('/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/',$email)){
        alert_back('邮件格式不正确!');
    }
    if (strlen($email) < $_min_num || strlen($email) > $_max_num){
        alert_back('邮件长度不合法');
    }
    return $email;
}

/**
 * QQ过滤函数
 * @access public
 * @param string $_QQ
 * @return string $_QQ QQ号码
 */
function check_QQ($_QQ){
    if (!empty($_QQ)){
        if (!preg_match('/^[1-9]{1}[0-9]{4,9}$/',$_QQ)){
            alert_back('QQ号码格式不正确!');
        }
    }
    return $_QQ;
}

/**
 * 网址验证
 * @access public
 * @param string $_url  受污染的主页
 * @return string $_url        过滤后的主页
 */
function check_url($_url,$_max_num=40){
    if (empty($_url) || ($_url == 'http://' )){
        return null;
    }
    else {
        if(!preg_match('/^https?:\/\/(\w+\.)?[\w\-\.]+(\.\w+)+$/',$_url)){
            alert_back('主页格式错误,请重新填写!');
        }
        if (strlen($_url) > 40){
            alert_back('主页太长!');
        }
    }
    return $_url;
}

/**
 * 唯一标识符函数
 * @param $_first_uniqid
 * @param $_end_uniqid
 * @return mixed
 */
function check_uniqid($_first_uniqid,$_end_uniqid){
    if ((strlen($_first_uniqid) != 40) || ($_first_uniqid != $_end_uniqid)){
        alert_back('非法注册!');
    }
    return $_first_uniqid;
}

/**
 * 输入内容长度判断
 * @param string $_string
 * @param int $min_max
 * @return mixed
 */
function check_content($_string,$min_max){
    if (mb_strlen($_string,'utf-8') > $min_max){
        alert_back("内容不得大于{$min_max}位!");
    }
    return $_string;
}

/**
 * 帖子标题判断
 * @param $string
 * @param $min
 * @param $max
 * @return mixed
 */
function check_post_title($string,$min,$max){
    if (mb_strlen($string,'utf-8') < $min || mb_strlen($string,'utf-8') > $max){
        alert_back("标题应大于".$min."位小于".$max."位!");
    }
    return $string;
}

/**
 * 帖子内容判断
 * @param $string
 * @param $min
 * @return mixed
 */
function check_post_content($string,$min){
    if (mb_strlen($string,'utf-8') < $min){
        alert_back("内容大于".$min."位");
    }
    return $string;
}