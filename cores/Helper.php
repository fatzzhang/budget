<?php

function f3()
{
    return \Base::instance();
}

function md()
{
    $config = f3()->get('db_md');
    return new \Medoo\Medoo([
        // required
        'database_type' => 'mysql',
        'database_name' => 'name',
        'server' => 'localhost',
        'username' => 'your_username',
        'password' => 'your_password',

        // [optional]
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_general_ci',
        'port' => 3306,

        // [optional] Table prefix
        'prefix' => 'PREFIX_',
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
