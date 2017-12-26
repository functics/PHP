<?php

// 参数赋值
$g_log_dir          = G_LOG_DIR;
$g_cache_dir        = G_CACHE_DIR;
$g_eshop_router_url = G_ESHOP_ROUTER_URL;
$g_front_host       = G_FRONT_HOST;

//日志
if(empty($g_log_dir)) $g_log_dir = DOCKING_PATH;
if(substr($g_log_dir, -1, 1) != '/') $g_log_dir .= '/';
$g_log_dir_append = '';

if(substr($g_cache_dir, -1, 1) != '/') $g_cache_dir .= '/';

//禁止写日志
$g_disable_logx = false;
function disableLogx($diable=TRUE)
{
    global $g_disable_logx;
    $g_disable_logx = $diable;
}

function logx($msg, $error=FALSE)
{
    global $g_current_api, $g_log_dir, $g_disable_logx;
    if($g_disable_logx) return;

    $current_sid = request('sid','default');
    
    $tm = time();
    
    $dt = date('Y-m-d', $tm);
    
    $pid = getmypid();
    
    $file_dir = "{$g_log_dir}{$g_current_api}/{$dt}";

    if(!is_dir($file_dir))
    {
        @mkdir($file_dir,0777,true);
    }
    
    if($error) $sid = $current_sid;
    
    if($error)
        $log_file = "{$g_log_dir}{$g_current_api}/error.log";
    else
        $log_file = "{$g_log_dir}{$g_current_api}/{$dt}/{$current_sid}.log";
    file_put_contents($log_file, date('Y-m-d H:i:s', $tm) . "\t{$pid}\t{$msg}\n", FILE_APPEND);
}

function _error_handler($severity, $message, $filepath, $line)
{
    if ($severity == E_STRICT)
    {
        return;
    }
    
    $error_reporting = error_reporting();
    if($error_reporting == 0)
    {
        return;
    }
    
    logx("PHP Error Severity: $severity --> $message $filepath $line");
}

set_error_handler('_error_handler');

function rc4($key, $str) {
    $s = array();
    for ($i = 0; $i < 256; $i++) {
        $s[$i] = $i;
    }
    $j = 0;
    for ($i = 0; $i < 256; $i++) {
        $j = ($j + $s[$i] + ord($key[$i % strlen($key)])) % 256;
        $x = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $x;
    }
    $i = 0;
    $j = 0;
    $res = '';
    for ($y = 0; $y < strlen($str); $y++) {
        $i = ($i + 1) % 256;
        $j = ($j + $s[$i]) % 256;
        $x = $s[$i];
        $s[$i] = $s[$j];
        $s[$j] = $x;
        $res .= $str[$y] ^ chr($s[($s[$i] + $s[$j]) % 256]);
    }
    return $res;
}

function decodeDbPwd($pwd)
{
    return rc4('%jkwer#@sMKuw', base64_decode($pwd));
}

//本地文件缓存
function cacheGet($key, $secs)
{
    global $g_cache_dir;
    
    $path = $g_cache_dir . md5($key);
    
    $str = @file_get_contents($path);
    if(empty($str)) return NULL;
    
    $obj = unserialize($str);
    if(!$obj) return NULL;
    
    $now = time(NULL);
    if($now - $obj['time'] > $secs)
    {
        @unlink($path);
        return NULL;
    }
    
    return $obj['val'];
}

function cachePut($key, $val)
{
    global $g_cache_dir;
    
    $path = $g_cache_dir . md5($key);
    
    $obj = array(
        'time' => time(NULL),
        'val' => $val
    );
    
    file_put_contents($path, serialize($obj));
}

//得到用户数据库连接
function getUserDb($userID)
{
    if(PHP_OS != 'Linux'){
        $test=array(
            'host'=>'121.199.38.85',
            'user'=>'root',
            'pwd'=>base64_decode('aGh5c2J5aiFRQFc='),
            'name'=>'eshop_newdev'
        );
        if($userID == 'gx'){
            $test=array(
            'host'=>'121.199.38.85',
            'user'=>'root',
            'pwd'=>base64_decode('aGh5c2J5aiFRQFc='),
            'name'=>'gongxiao_v1'
            );
        }
        $mysql = new MySQLdb($test['host'], $test['user'], $test['pwd'], false, $test['name']);
        if(!$mysql->connect())
        {
            return NULL;
        }
        if($mysql->execute('SET NAMES UTF8') === false)
        {
            $mysql->close();
            return NULL;
        }
        return $mysql;
    }

    global $g_eshop_router_url, $g_front_host;
    
    $conf = cacheGet("userdb-{$userID}", 300);
    
    if(!$conf)
    {
        //$str = file_get_contents("$g_eshop_router_url/get_userdb?sid=" . urlencode($userID));
        $ch = curl_init("$g_eshop_router_url/get_userdb?sid=" . urlencode($userID));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $str = curl_exec($ch);
        $result = json_decode($str, true);
        if(!$result)
        {
            return NULL;
        }
        
        $host = $result[0];
        $db_name = $result[1];
        $instance = $result[2];
        
        $db_user = $result[3];
        $db_pwd = decodeDbPwd($result[4]);
        $front_host = $result[5];
        
        if($g_front_host != $front_host)
        {
            //showError(1, '无效服务器');
        }
        
        $conf = array('host'=>$host, 'instance'=>$instance, 'db_name'=>$db_name, 'db_user'=>$db_user, 'db_pwd'=>$db_pwd);
        cachePut("userdb-{$userID}", $conf);
    }
    
    $host = $conf['host'];
    $instance = $conf['instance'];
    $db_name = $conf['db_name'];
    $db_user = $conf['db_user'];
    $db_pwd = $conf['db_pwd'];
    
    if(empty($db_name))
    {
        logx("Invalid Database config");
        return NULL;
    }
    if($userID == 'test21')
        $host = "p:".$host;
    $mysql = new MySQLdb($host, $db_user, $db_pwd, false, $db_name);
    if(!$mysql->connect())
    {
        logx("Mysql Connect Fail: {$host} {$instance} {$db_user} {$db_name}");
        return NULL;
    }
    
    if($mysql->execute('SET NAMES UTF8') === false)
    {
        $mysql->close();
        logx("Mysql set encodeing Fail");
        return NULL;
    }
    
    return $mysql;
}


/*
*   获取REQUEST参数,GET和POST的参数都可以获取到
*   @parameter 键名
*   @parameter 默认值
*/
function request($key, $def='')
{
    if(isset($_REQUEST[$key]))
    {
        if(get_magic_quotes_gpc()) //解决php对_Post[]内容的自动添加转义符
            return stripslashes($_REQUEST[$key]);
        else
            return $_REQUEST[$key];
    }
    
    return $def;
}

/*
*   将请求参数打包
*/
function packRequest($req=NULL)
{
    if(!$req) $req = $_REQUEST;
    
    ksort($req);
    
    $arr = array();
    foreach($req as $key => $val)
    {
        if(get_magic_quotes_gpc()) //解决php对_Post[]内容的自动添加转义符
            $val = stripslashes($val);
        if($key == 'sign') continue;
        
        if(count($arr))
            $arr[] = ';';
        
        $arr[] = sprintf("%02d", iconv_strlen($key, 'UTF-8'));
        $arr[] = '-';
        $arr[] = $key;
        $arr[] = ':';
        
        $arr[] = sprintf("%04d", iconv_strlen($val, 'UTF-8'));
        $arr[] = '-';
        $arr[] = $val;
    }
    
    return implode('', $arr);
}

/*
*   接口权限检查
*/
function checkAuth(&$db, $request, $sign, $rights, $ip)
{
    $appkey = request('appkey', '');
    if(empty($appkey))
    {
        showError(100, "无效appkey:{$appkey}");
    }
    
    $now = time();
    $timestamp = $now - (int)request('timestamp', '');
    if($timestamp > 300 OR  $timestamp < -300)
    {
        showError(100, '无效timestamp');
    }
    
    $sql = "SELECT * FROM cfg_openapi_key WHERE app_key='" . $db->escape_string($appkey) . "'";
    $row = $db->query_result($sql);
    if(!$row)
    {
        showError(100, "无效appkey:{$appkey}");
    }
    if($row['is_disabled'] != 0)
    {
        showError(100,'已经停用');
    }
    $wdt_sign = md5($request . $row['app_secret']);
    if( $wdt_sign!= $sign)
    {
        showError(100, '无效sign'.$wdt_sign);
    }
}

function showError($code,$msg){

    $arr = array(
        'code' => $code,
        'message' => $msg
    );
    die(json_encode($arr));
}

function returnInfo($info)
{
    die(json_encode($info));
}

function createTempTableSaveID(&$db){
    $sql =<<<SQL
CREATE TEMPORARY TABLE IF NOT EXISTS tmp_save_id(
rec_id INT(11) NOT NULL AUTO_INCREMENT,
id INT(11),
PRIMARY KEY (rec_id)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;
SQL;
    if(false == $db->execute($sql)){
        showError("CreateTempTable Failed");
    }
}

function clearTempTableSaveID(&$db){
    $sql = "DELETE FROM tmp_save_id";
    if(false == $db->execute($sql)){
        showError("ClearTempTable Failed");
    }
}

function insertTempTableSaveIDByLIMIT(&$db,$sql,$page_no,$page_size){
    $sql .= " LIMIT ".$page_no*$page_size.",".$page_size;
    if(!$db->execute("INSERT INTO tmp_save_id(id) $sql")){
        showError(501,'insertTempTableSaveIDByLIMIT service fail ');
    }
}

function debug_log($msg){
    logx("debug|".print_r($msg,true));
}
?>
