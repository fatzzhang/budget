<?php
namespace FATZ;

class mItem extends Model
{
    const MT = 'item';
    const PK = 'id';

    public static function all()
    {
        return parent::result();
    }

    public static function set($data)
    {
        return self::save($data);
    }
}
