<?php
namespace Tiny\Service;

use Tiny\Config\Application;
use Tiny\Db\Pdo;

class Factory
{
    public static function getDatabase()
    {
        $dbConfig = Application::getInstance()->config['database'];
        $db = Register::get('db');
        if (!$db) {
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
            Register::set('db', $db);
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
