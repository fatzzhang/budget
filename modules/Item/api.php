<?php
namespace FATZ;

class aItem extends Api
{
    public static function do_list()
    {
        $data = mItem::all();
    }
}
