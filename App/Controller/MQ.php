<?php

namespace App\Controller;

use Tiny\MessageQueue\UserMQ;

class Mq
{
    /**
     * 将注册信息写入到缓存队列中
     */
    public function reg()
    {
        $data = ['username' => 'Michael2', 'email' => 'keke231@qq.com'];
        $mq = UserMQ::MQ();
        $mq->push($data);

        //$popInfo = $mq->pop($data);
        //print_r($popInfo);

    }
}
