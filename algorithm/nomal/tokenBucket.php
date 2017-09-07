<?php

/**
 * 令牌桶算法，用于实现接口访问次数的限制
 * 令牌的存储方式可以是Redis、Memcache、文件缓存等
 */
class TokenBucket
{
    protected $timestamp;           //时间戳
    protected $lastRefillTime;      //最后一次补充Token的时间
    protected $tokenRemaining;      //Token剩余量
    protected $interval;            //时间间隔
    protected $capacity;            //Bucket的最大容量
    protected $intervalPerToken;    //补充一枚Token的间隔时间(s)
    protected $maxBurstInterval;    //允许中断的最大时间间隔，用于Token的初始化
    protected $key;                 //缓存键值
    protected $expire;              //缓存有效期
    protected $memcache;            //memcache实例

    public function __construct ($capacity, $interval, $maxBurstInterval = 3000)
    {
        $this->capacity = $capacity;
        $this->interval = $interval;
        $this->intervalPerToken = ($this->interval / $this->capacity);
        $this->timestamp = time();
        $this->maxBurstInterval = $maxBurstInterval;
        $memcache = new memcache;
        $this->memcache = $memcache;
        $this->memcache->connect('127.0.0.1', 11211);
    }

    /**
     * 请求Token
     */
    public function requestToken ()
    {
        $expire = true;
        if ($this->getTokenRemaining())
        {
            $expire = false; //桶内的token没有过期
            $intervalCall = $this->timestamp - $this->lastRefillTime;//距离上次补充Token的时间间隔
        }
        //如果两次请求的时间间隔小于接口规定的时间间隔，并且Token未过期，计算当前的Token剩余量
        if (!$expire && isset($intervalCall) && $intervalCall < $this->interval)
        {
            //此次Token需要补充的数量
            $fillToken = floor($intervalCall / $this->intervalPerToken);
            //补充完之后当前的Token剩余量
            $currentToken = min($fillToken + $this->tokenRemaining, $this->capacity);
            //如果Token剩余量不为0，则消耗掉一枚Token，更新Token剩余量和上次补充Token的时间，并放入桶内
            if ($currentToken > 0)
            {
                $bucket = array(
                    'tokenRemaining' => $currentToken - 1,
                    'lastRefillTime' => $this->timestamp
                );
                $this->setTokenRemaining($bucket);
                print_r($this->memcache->get($this->key));
                return true;
            }
            //如果当前的Token剩余量为0，则更新上次补充Token的时间，并放入桶内，返回false，程序退出
            else{
                $bucket = array(
                    'tokenRemaining' => $currentToken,
                    'lastRefillTime' => $this->timestamp
                );
                $this->setTokenRemaining($bucket);
                return false;
            }
        }
        //如果大于规定的时间间隔，或者桶内的Token过期，初始化Token的数量
        else{
            //计算初始化Token的数量
            $token = min(floor($this->maxBurstInterval / $this->intervalPerToken), $this->capacity);
            //放入桶内
            $bucket =array(
                'tokenRemaining' => $token,
                'lastRefillTime' => $this->timestamp
            );
            $this->setTokenRemaining($bucket);
            return true;
        }
    }

    /**
     * 获取当前Token剩余量
     */
    protected function getTokenRemaining()
    {
        $bucket = $this->memcache->get($this->key);
        if ($bucket && is_array($bucket))
        {
            $this->tokenRemaining = $bucket['tokenRemaining'];
            $this->lastRefillTime = $bucket['lastRefillTime'];
            return true;
        }
        return false;
    }

    /**
     * 更新Token剩余量
     * @param $bucket
     */
    protected function setTokenRemaining($bucket)
    {
        $this->memcache->set($this->key, $bucket, MEMCACHE_COMPRESSED, $this->expire);
    }

    /**
     * 设置缓存的key
     * @param String $key
     */
    public function setKey($key){
        $this->key = $key;
    }

    /**
     * 设置有效时间
     *  @param String $expire
     */
    public function setExpire($expire){
        $this->expire = $expire;
    }
}

$test = new TokenBucket(10, 10);
$test->setKey('test');
$test->setExpire(0);
echo $test->requestToken()."#".PHP_EOL;
echo $test->requestToken()."#".PHP_EOL;
echo $test->requestToken()."#".PHP_EOL;
echo $test->requestToken()."#".PHP_EOL;
echo $test->requestToken()."#".PHP_EOL;
echo $test->requestToken()."#".PHP_EOL;
echo $test->requestToken()."#".PHP_EOL;
echo $test->requestToken()."#".PHP_EOL;
echo $test->requestToken()."#".PHP_EOL;
echo $test->requestToken()."#".PHP_EOL;

echo $test->requestToken()."#".PHP_EOL;
echo $test->requestToken()."#".PHP_EOL;
echo $test->requestToken()."#".PHP_EOL;
echo $test->requestToken()."#".PHP_EOL;
echo $test->requestToken()."#".PHP_EOL;