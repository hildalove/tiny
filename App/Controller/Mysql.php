<?php

namespace App\Controller;


use Tiny\Service\Factory;

class Mysql
{
    public function index()
    {
        $db = Factory::getDatabase();
        $res = $db->getRow('select * from user');
        print_r($res);
        echo '<br>';
        $db->exec('UPDATE user SET password ="123" LIMIT 1');
    }
}