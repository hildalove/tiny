<?php
namespace App\Controller;

use Tiny\Controller\AbstractController;
use Tiny\Service\Factory;

class Home extends AbstractController
{
    public function index()
    {
       $data = 'Hello Tiny.';

       $this->assign('data', $data);
    }

    /**
     * Model
     */
    public function model()
    {
        $res = Factory::getModel('user')->getUserById(1);
        print_r($res);

    }

    /**
     * 测试PDO
     */
    public function pdo()
    {
        $db = \Tiny\Service\Factory::getDatabase();
        $res = $db->getRow('select * from user');
        print_r($res);
    }

    /**
     * 测试Redis连接
     */
    public function redis()
    {
        $redis = \Tiny\Service\Factory::getRedis();
        $redis->set('name', 'hanfeng');
        echo $redis->get('name');
    }

}