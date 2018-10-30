<?php

function f3()
{
    return \Base::instance();
}

function md()
{
    $config = f3()->get('db_md');
    // var_dump($config);die();
    return new \Medoo\Medoo([
        // required
        'database_type' => $config['database_type'],
        'database_name' => $config['database_name'],
        'server' => $config['server'],
        'username' => $config['username'],
        'password' => $config['password'],

        // [optional]
        'charset' => $config['charset'],
        'collation' => $config['collation'],
        'port' => $config['port'],

        // [optional] Table prefix
        // 'prefix' => $config['prefix'],
    ]);
}

function isDev()
{
    return $_SERVER['ENV'] !== 'production';
}

function isAjax()
{
    return f3()->get('AJAX');
}
