<?php
/**
 * Created by PhpStorm.
 * User: 子兴的期盼
 * Date: 2016/11/12
 * Time: 20:54
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
    //去掉两边的空格
    $_string = trim($_string);
    //长度小于2位大于20位
    if (mb_strlen($_string,'utf-8') < $_min_num || mb_strlen($_string,'utf-8') > $_max_num){
        alert_back('长度不得小于'.$_min_num.'位大于'.$_max_num.'位');
    }
    //限制敏感字符
    $_char_pattern = '/[<>\'\"\ \　]/';     //桉顺序限制 < > ' " \ 英文空格 中文空格
    if (preg_match($_char_pattern,$_string)){
        alert_back('用户名不能包含敏感字符!');
    }
    return $_string;
}

/**
 * 验证密码函数
 * @access public
 * @param string $password 密码
 * @param int $_min_num  最小位数
 * @return string  返回sha1加密后的密码
 */
function check_password($password,$_min_num){
    //判断密码
    if (strlen($password) < $_min_num){
        alert_back('密码不得小于'.$_min_num.'位!');
    }
    //将密码返回
    return sha1($password);
}
