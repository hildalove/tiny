<?php

namespace Tiny\MessageQueue;

use Tiny\Cache\RedisPool;

trait SingletonTrait
{
    private static $connection = null;

    public static function MQ()
    {
        if (self::$connection === null) {
            self::$connection = new self();
            self::$connection->init();
        }
        return self::$connection;
    }
}

abstract class PHPMQ
{
    private $redis;

    abstract protected function getKey();

    /**
     * 把消息打包
     * @param $message
     * @return mixed
     */
    abstract public function package($message);

    /**
     * 把消息解包
     * @param $message
     * @return mixed
     */
    abstract public function unpackage($message);

    protected function init()
    {
        $config = [ 'redis0' => ['host' => '192.168.10.10' , 'port' => 6379]];
        RedisPool::addServer($config);
        $this->redis = RedisPool::getRedis('redis0');
    }

    /**
     * 入队列
     * @param $message
     */
    public function push($message)
    {
        $this->redis->lPush($this->getKey(), $this->package($message));
    }

    /**
     * 出队列
     * @return mixed
     */
    public function pop()
    {
        return $this->unpackage($this->redis->rPop($this->getKey()));
    }
}