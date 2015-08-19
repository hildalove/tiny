<?php

namespace App\Controller;

use Tiny\Controller\AbstractController;

/**
 * Class User
 * 使用Redis存储用户名和密码，登录的例子
 * @package App\Controller
 */
class User extends  AbstractController
{
    public function login()
    {
        if (!empty($_POST)) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $redis = \Tiny\Service\Factory::getRedis();

            //判断密码是否正确。
            if ($password = $redis->get('string:user:' . $username)) {
                echo 'login success';
            } else {
                echo 'login fail.';
            }
        }
    }

    public function register()
    {
        if (!empty($_POST)) {
            var_dump($_POST);
            $username = $_POST['username'];
            $password = $_POST['password'];
            $redis = \Tiny\Service\Factory::getRedis();

            //存储用户名和密码
            $redis->set('string:user:' . $username, $password);
            $redis->lPush('list:user', $username);
            $a = $redis->lRange('list:user', 0, -1);
            print_r($a);
            die();
        }
    }
}