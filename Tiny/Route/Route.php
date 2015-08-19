<?php
namespace Tiny\Route;

class Route
{
    public static function dispatch()
    {
        $uri = $_SERVER['REQUEST_URI']; // /home/index

        list($c, $v) = explode('/', trim($uri, '/'));

        //$c_low = strtolower($c);
        $c = ucwords($c);
        $class = '\\App\\Controller\\' . $c;
        $obj = new $class($c, $v);
        $obj->$v();
    }
}