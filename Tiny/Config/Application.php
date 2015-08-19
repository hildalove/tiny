<?php
namespace Tiny\Config;

class Application
{
    public $baseDir;
    private static $instance;
    public $config;

    /**
     * @param $baseDir 网站根目录
     * 单例模式
     */
    private function __construct($baseDir)
    {
        $this->baseDir = $baseDir;
        $this->config = new Config($baseDir . 'configs');
    }

    public static function getInstance($baseDir = BASE_DIR)
    {
        if (empty(self::$instance)) {
            self::$instance = new self($baseDir);
        }

        return self::$instance;
    }
}