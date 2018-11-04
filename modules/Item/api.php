<?php
namespace FATZ;

class aItem extends Api
{
    public static function do_list()
    {
        $data = mItem::lots();
        parent::_return(0, $data);
        // parent::_return(0, [
        //     [
        //         'id' => 1,
        //         'name' => '手機',
        //         'price' => 20000,
        //         'status' => 'normal',
        //         'insert_ts' => '2018-10-30 23:54:52',
        //         'insert_id' => 1,
        //         'update_ts' => '2018-10-30 23:54:52',
        //         'update_id' => 1,
        //     ],
        //     [
        //         'id' => 2,
        //         'name' => '電腦',
        //         'price' => 50000,
        //         'status' => 'normal',
        //         'insert_ts' => '2018-10-30 23:54:52',
        //         'insert_id' => 1,
        //         'update_ts' => '2018-10-30 23:54:52',
        //         'update_id' => 1,
        //     ],
        // ]);
    }

    public static function do_set()
    {
        $need = ['name', 'price', 'note'];

        $req = parent::_getReq('POST', $need);
        parent::_chkReq($req, $need);

        parent::_return(0, $req);
    }
}
