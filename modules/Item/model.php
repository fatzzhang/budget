<?php
namespace FATZ;

class mItem extends Model
{
    const MT = 'item';

    public static function lots()
    {
        return parent::result();
    }

    public static function set()
    {

    }
}
