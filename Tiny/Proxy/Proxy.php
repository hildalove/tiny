<?php

namespace Tiny\Proxy;

use Tiny\Service\Factory;

class Proxy
{
    public function __call($method, $args)
    {
        $sql = $args[0];
        if (strtolower(substr($sql, 0 , 6)) == 'select') {
            echo '读操作<br>';
            $db = Factory::getDatabase('slave');
            return call_user_func_array([$db, $method], $args);
        } else {
            echo '写操作<br>';
            $db = Factory::getDatabase('master');
            return call_user_func_array([$db, $method], $args);
        }
    }
}