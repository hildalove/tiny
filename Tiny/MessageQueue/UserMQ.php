<?php

namespace Tiny\MessageQueue;


class UserMQ extends PHPMQ
{
    use SingletonTrait;

    protected function getKey()
    {
        return 'list:user:reg';
    }

    public function package($message)
    {
        return json_encode($message);
    }

    public function unpackage($message)
    {
        return json_decode($message, true);
    }

}