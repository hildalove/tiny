<?php
/**
 *  读取Reis里的用户注册信息队列，写入到数据库
 *  todo: 将此脚本开启自动启动
 * 问题: 写入数据库失败怎么办？ 这个进行停掉了怎么办？
 */
require '../../int.inc.php';
$flag = true;

use Tiny\MessageQueue\UserMQ;
$mq = UserMQ::MQ();
while ($flag) {
    $data = $mq->pop();
    if ($data) {
        $db = \Tiny\Service\Factory::getDatabase();
        $sql = "INSERT INTO user
        SET username = ?,
            email = ?";
        $db->exec($sql, $data['username'], $data['email']);
    }
}

