<?php

namespace Tiny\Service;


class Register
{
    private static $objects;

    public static function set($alias, $object)
    {
        self::$objects[$alias] = $object;
    }

    public static function get($alias)
    {
        if (isset(self::$objects[$alias])) {
            return self::$objects[$alias];
        }
        return false;
    }

    public function _unset($alias)
    {
        unset(self::$objects[$alias]);
    }
}