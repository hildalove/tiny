<?php
return [
    'master' => [
        'host'     => '192.168.33.12',
        'dbname'   => 'tiny',
        'user'     => 'michael',
        'password' => '1234',
        'port'     => 3306,
    ],
    'slave'  => [
        'slave1' => [
            'host'     => '192.168.33.10',
            'dbname'   => 'tiny',
            'user'     => 'michael2',
            'password' => '1234',
            'port'     => 3306,
        ],
    ],
];