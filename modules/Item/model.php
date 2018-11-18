<?php
namespace FATZ;

class mItem extends Model
{
    const MT = 'item';
    const PK = 'id';

    public static function all()
    {
        $data = parent::result();
        return $data;
    }

    public static function set($data)
    {
        return self::save($data);
    }
}
