<?php
namespace FATZ;

class Model extends Module
{
    public static function result(array $condition)
    {
        md()->select();
    }

    public static function save($data, $child_tbl = '')
    {
        $tbl = self::getTable($child_tbl);
        $key = self::getKey();
        if (empty($data[$key])) {
            // TODO: add insert and update id
            md()->insert($tbl, $data);
        } else {
            // TODO: add update id
            md()->update($tbl, $data, [$key => $data[$key]]);
        }

        if (!self::chkErr()) {
            return false;
        }

        return md()->id() ?? true;
    }

    public static function getKey()
    {
        $that = get_called_class();
        return constant($that . '::PK');
    }

    public static function getTable($child)
    {
        $that = get_called_class();
        return constant($that . '::MT');
    }

    protected static function chkErr()
    {
        $error = md()->error();
        if (is_array($error)) {
            if (isDev()) {
                echo json_encode($error);
                die();
            } else {
                return false;
            }
        }
        return true;
    }
}
