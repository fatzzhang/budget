<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../cores/Loader.php';
require_once __DIR__ . '/../cores/Helper.php';

$f3 = \Base::instance();

$f3->set('CACHE', __DIR__ . '/../cache');

//env detect
if ($_SERVER['ENV'] != 'production') {
    $f3->set('enviromnment', 'developement');
    $f3->set('DEBUG', 3);
} else {
    $f3->set('enviromnment', 'production');
    $f3->set('DEBUG', 0);
}

//config
$f3->config(__DIR__ . '/../configs/' . $f3->get('enviromnment') . '.cfg');

//route
$f3->config(__DIR__ . '/../configs/routes.cfg');

$f3->run();
