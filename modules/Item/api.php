<?php
namespace FATZ;

class aItem extends Api
{
    public static function do_list()
    {
        // $data = mItem::all();
        echo json_encode([
            'code' => 0,
            'data' => [
                'items' => [
                    0 => [
                        'name' => '測試一',
                        'price' => '100',
                        'date' => '2018/10/30',
                    ],
                ],
            ],
        ]);
    }
}
