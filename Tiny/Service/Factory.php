<?php
namespace Tiny\Service;

use Tiny\Config\Application;
use Tiny\Db\Pdo;
use Tiny\Proxy\Proxy;

class Factory
{
    private static $proxy = null;
    public static function getDatabase($id = 'proxy')
    {
        $registerId = 'db_' . $id;
        $db = Register::get($registerId);
        if (!$db) {
            if ($id == 'proxy') {
                if (self::$proxy === null) {
                    self::$proxy = new Proxy();
                }
                return self::$proxy;
            }

            if ($id == 'master') {
                $dbConfig = Application::getInstance()->config['database']['master'];
            } else {
                $slaves = Application::getInstance()->config['database']['slave'];
                $slaveId = array_rand($slaves);
                $dbConfig = Application::getInstance()->config['database']['slave'][$slaveId];
            }

            try {
                $dsn = 'mysql:host=' . $dbConfig['host'] . ';dbname=' . $dbConfig['dbname'] . ';port:' . $dbConfig['port'];
                $db = new Pdo($dsn, $dbConfig['user'], $dbConfig['password']);
            } catch (\PDOException $e) {
                echo 'Oops! we are truly sorry but there is been a problem executing your operation.<br />
                    Our webmaster it\'s been notified of the error.<br />
                    We apologize for the inconvenience.';
                // todo   send a email to admin
                exit();
            }

            $db->query("SET NAMES 'UTF8'");
            // set the default fetch mode
            $db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            Register::set($registerId, $db);
        }
        return $db;
    }

    public static function getRedis()
    {
        $config = Application::getInstance()->config['redis'];
        $redis = Register::get('redis');

        if (!$redis) {
            $redis = new \Redis();
            $redis->connect($config['host'], $config['port']);
            Register::set('redis', $redis);
        }
        return $redis;
    }

    public static function getModel($name)
    {
        $key = 'app_model_' . $name;
        $model = Register::get($key);
        if (!$model) {
            $class = '\\App\\Model\\' . ucwords($name);
            $model = new $class;
            Register::set($key, $model);
        }
        return $model;
    }
}
