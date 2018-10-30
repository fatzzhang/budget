<?php
namespace FATZ;

class Api
{
    public static function _return()
    {

    }

    public function do_rerouter($f3, $args)
    {
        try {
            // Create an instance of the module class.
            $class = '\FATZ\a' . ucfirst($args['module']);
            if (!isset($args['action'])) {
                $method = sprintf('do_%s', $args['method']);
            } else {
                $method = sprintf('%s_%s', $args['action'], $args['method']);
            }

            if (!method_exists($class, $method)) {
                return self::_return(404);
            }

            // Create a reflection instance of the module, and obtaining the action method.
            $reflectionClass = new \ReflectionClass($class);
            $reflectionInstance = $reflectionClass->newInstance();
            $reflectionMethod = $reflectionClass->getMethod($method);

            // Invoke module action.
            $reflectionMethod->invokeArgs(
                $reflectionInstance,
                array($f3, $args)
            );
        } catch (Exception $e) {
            // return self::_return($e->getCode());
            echo json_encode($e);
        }

    }
}
