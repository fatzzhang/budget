<?php
namespace FATZ;

class aItem extends Api
{
    public static function do_list()
    {
        $data = mItem::all();
        parent::_return(0, $data);
    }

    public static function do_set()
    {
        $need = ['name', 'price'];

        $req = parent::_getReq('POST', array_merge($need));
        parent::_chkReq($req, $need);

        $res = mItem::set([
            'name' => $req['name'],
            'price' => $req['price'],
        ]);

        if ($res === false) {
            parent::_return(9100);
        }

        parent::_return(0);
    }
}
