<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../cores/Loader.php';
require_once __DIR__ . '/../cores/Helper.php';

$f3 = \Base::instance();

$f3->set('TEMP', __DIR__ . '/../tmps/');

// AutoLoad
// $f3->set('AUTOLOAD', __DIR__ . '/../modules/;/../cores/;/../vendor/');

//env detect
if (isDev()) {
    $env = 'developement';
    $f3->set('DEBUG', 3);
    $f3->set('ONERROR', function ($f3) {
        $err = $f3->get('ERROR');
        if (isAjax()) {
            \FATZ\Api::_return($err['code'], [
                'status' => $err['status'],
                'level' => $err['level'],
                'text' => $err['text'],
                'trace' => $err['trace'],
            ]);
        } else {
            echo json_encode($err);
            // \FATZ\Page::_echo();
        }

    });
} else {
    $env = 'production';
    $f3->set('DEBUG', 0);
    $f3->set('ONERROR', function ($f3) {
        $err = $f3->get('ERROR');
        Api::_return($err['code'], [
            'status' => $err['status'],
            'level' => $err['level'],
            'text' => $err['text'],
            'trace' => $err['trace'],
        ]);
    });
}

if (isset($_SERVER['HTTP_HOST'])) {
    if (in_array($_SERVER['HTTP_HOST'], ['local.budget.tw'])) {
        $f3->set('CORS.credentials', true);
        $f3->set('CORS.origin', $_SERVER['HTTP_ORIGIN']);
        $f3->set('CORS.headers', 'X-Requested-With, Content-Type, Origin, Accept, Content-Range, Content-Disposition, X-Requested-Token');
        $f3->set('CORS.expose', 'true');
        $f3->set('CORS.ttl', '86400');
    }
}

//config
$f3->config(__DIR__ . '/../configs/' . $env . '.cfg');

//route
$f3->config(__DIR__ . '/../configs/routes.cfg');

$f3->run();
