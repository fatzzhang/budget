<?php

function f3()
{
    return \Base::instance();
}

function isDev()
{
    return $_SERVER['ENV'] !== 'production';
}

function isAjax()
{
    return f3()->get('AJAX');
}
