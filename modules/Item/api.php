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
                    [
                        'name' => '測試一',
                        'price' => '100',
                        'date' => '2018/10/30',
                    ],
                    [
                        'name' => '測試二',
                        'price' => '200',
                        'date' => '2018/10/31',
                    ],
                ],
            ],
        ]);
    }
}
