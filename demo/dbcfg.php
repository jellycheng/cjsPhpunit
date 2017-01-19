<?php

return [
    'driver'    => 'mysql',
    'host'      => \CjsPhpunit\env('DB_HOST', 'localhost'),
    'database'  => \CjsPhpunit\env('DB_DATABASE', 'db_test8'),
    'username'  => \CjsPhpunit\env('DB_USERNAME', 'root'),
    'password'  => \CjsPhpunit\env('DB_PASSWORD', '888888'),
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
    'strict'    => false,
];
