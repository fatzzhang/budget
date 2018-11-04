<?php
namespace FATZ;

class Api
{
    public static function _getReq($method, $allow = [])
    {
        $data = f3()->get(strtoupper($method));
        foreach ($data as $k => $v) {
            if (in_array($k, $allow)) {
                $data[$k] = is_string($v) ? trim($v) : $v;
            } else {
                unset($data[$k]);
            }
        }
        return $data;
    }

    public static function _chkReq($req, $need)
    {
        foreach ($need as $v) {
            if (!isset($req[$v])) {
                self::_return(8100);
            }
        }

        return true;
    }

    public static function _return($code, $data = [])
    {
        header('Content-Type: application/json');

        echo json_encode([
            'code' => intval($code),
            'data' => $data,
        ]);
        exit;
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
