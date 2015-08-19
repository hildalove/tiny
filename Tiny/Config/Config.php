<?php
namespace Tiny\Config;

class Config implements \ArrayAccess
{
    private $path;
    private $configs = [];

    /**
     * @param $path 配置文件路径
     */
    public function __construct($path)
    {
        $this->path = $path;
    }
    public function offsetExists($key)
    {
        return isset($this->configs[$key]);
    }

    public function offsetGet($key)
    {
        if (!isset($this->configs[$key])){
            $filePath = $this->path . '/' . $key . '.php';
            $this->configs[$key] = require $filePath;
        }
        return $this->configs[$key];
    }

    public function offsetSet($key, $value)
    {
        throw new \Exception('Can not write config.');
    }

    public function offsetUnset($key)
    {
        unset($this->configs[$key]);
    }

}