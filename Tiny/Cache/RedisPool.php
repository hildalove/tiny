<?php

namespace Tiny\Cache;


class RedisPool
{
    /**
     * @var array 存储Redis Instance
     */
    private static $connections = [];
    /**
     * @var array 存储redis配置信息
     */
    private static $servers = [];

    /**
     * @param $configs
     * @example
     * [ 'redis0' => ['host' => '192.168.10.10' , 'port' => 6379, 'auth' => 1234]]
     */
    public static function  addServer($configs)
    {
        foreach ($configs as $alias => $config) {
            self::$servers[$alias] = $config;
        }

    }

    public static function getRedis($alias)
    {
        // 单例模式
        if (isset(self::$connections[$alias])) {
            return  self::$connections[$alias];
        }
        self::$connections[$alias] = new \Redis();
        self::$connections[$alias]->connect(self::$servers[$alias]['host'], self::$servers[$alias]['port']);
        if (isset(self::$servers[$alias]['auth'])) {
            self::$connections[$alias]->auth(self::$servers[$alias]['auth']);
        }
        return self::$connections[$alias];
    }
}
