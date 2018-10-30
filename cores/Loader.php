<?php
namespace FATZ;

class Loader
{
    const NS = 'FATZ';
    const CORES = ['Module', 'Api', 'Model', 'Page', 'Kit'];
    const TYPES = [
        'a' => 'api',
        'm' => 'model',
        'p' => 'page',
        'k' => 'kit',
    ];

    public static function register()
    {
        if (function_exists('__autolad')) {
            spl_autoload_register('__autolad');
        }

        spl_autoload_register(['\FATZ\Loader', 'load']);
    }

    private static function load($class)
    {
        if (class_exists($class) || !preg_match('#' . self::NS . '#i', $class)) {
            return false;
        };
        $classArr = explode('\\', $class);
        $classname = end($classArr);
        $type = substr($classname, 0, 1);
        $module = substr($classname, 1);

        if (array_key_exists($type, self::TYPES)) {
            $filename = __DIR__ . '/../modules/' . $module . '/' . self::TYPES[$type] . '.php';

        } else if (in_array($classname, self::CORES)) {
            $filename = __DIR__ . '/../cores/' . $classname . '.php';

        } else {
            $filename = __DIR__ . '/../libs/' . $classname . '.php';
        }

        if (file_exists($filename)) {
            include $filename;
        } else {
            return false;
        }
    }
}

Loader::register();
