<?php
namespace Tiny\Loader;
class Loader
{
    public static function load($class)
    {
        require BASE_DIR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
    }
}

