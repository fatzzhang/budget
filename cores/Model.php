<?php
namespace FATZ;

class Model extends Module
{
    const TABLE_LIST = [
        'master' => 1,
        'branch' => 2,
    ];
    /**
     * get one record
     * @param  array  $where     condition
     * @param  string $cols      selected column
     * @param  array  $opts      additional options
     * @param  string $child_tbl child table
     * @return array             data
     */
    public static function row($where = [], $cols = '*', $opts = [], $child_tbl = '', $join = [])
    {
        $method = [md(), 'get'];
        $args = [
            self::getTable($child_tbl),
            $join,
            $cols,
            empty($order) ? $where : array_merge($where, ['ORDER' => $order]),
        ];

        if (empty($join)) {
            unset($args[1]);
        }

        $data = call_user_func_array($method, $args);

        self::chkErr();

        return empty($data) ? [] : $data;
    }

    /**
     * get records
     * @param  array  $where     condition
     * @param  string $cols      selected column
     * @param  array  $opts      additional options
     * @param  string $child_tbl child table
     * @return array             data
     */
    public static function result($where = [], $cols = '*', $opts = [], $child_tbl = '')
    {
        $data = md()->select(
            self::getTable($child_tbl),
            $cols,
            empty($order) ? $where : array_merge($where, $opts)
        );
        return empty($data) ? [] : $data;
    }

    /**
     * insert or update record
     * @param  array  $save      insert or update data
     * @param  array  $log       the action log
     * @param  string $child_tbl child table
     * @return bool              success or not
     */
    public static function save($save, $log = [], $child_tbl = '', $child_key = '')
    {
        $tbl = self::getTable($child_tbl);
        $key = self::getKey($child_key);

        $is_update = self::is_update($save, $key);
        if (is_array($save[0])) {
            //multi insertion
            $data = [];
            foreach ($save as $v) {
                array_push($data, array_merge($v, $log));
            }
        } else {
            $data = array_merge($save, $log);
        }

        if ($is_update) {
            $condition = self::parse($data, $key);
            $res = md()->update(
                $tbl,
                $data,
                $condition
            );
        } else {
            $res = md()->insert(
                $tbl,
                $data
            );
        }

        if (!self::chkErr()) {
            return false;
        };

        return empty(md()->id()) ? true : md()->id();
    }

    // TODO: replace metaSave
    /**
     * insert and update meta
     * @param  array  $save      data to save
     * @param  int    $parent_id parent id
     * @return int               error code
     */
    public static function saveMeta($save, $parent_id)
    {
        $tbl = self::getTable('META');

        $condition = [
            'parent_id' => $parent_id,
        ];
        $insert = [];

        foreach ($save as $k => $v) {
            $condition['k'] = $k;
            $one = md()->get($tbl, 'id', $condition); // TODO: 修改成一次撈出來可能會比較好

            if (empty($one)) {
                //use multi insertion
                $insert[] = array_merge($condition, ['v' => $v]);
            } else {
                //update
                $id = intval($one);
                md()->update($tbl, ['v' => $v], ['id' => $id]);
                if (!self::chkErr()) {
                    return 9101;
                }
            }
        }
        if (!empty($insert)) {
            md()->insert($tbl, $insert);
            if (!self::chkErr()) {
                return 9100;
            };
        }

        return 0;
    }

    /**
     * check if record exist
     * @param  array  $where     condition
     * @param  string $child_tbl child table
     * @return boolean           exist or not
     */
    public static function exist($where, $child_tbl = '')
    {
        return md()->has(
            self::getTable($child_tbl),
            $where
        );
    }

    /**
     * change record's status to disable
     * @param  array  $where     condition
     * @param  string $child_tbl child table
     * @return bool              success or not
     */
    public static function setDel($where = [], $key = 'status', $child_tbl = '')
    {
        $res = md()->update(
            self::getTable($child_tbl),
            [$key => self::ST_DEL],
            $where
        );

        return $res->rowCount() > 0; //affected row
    }

    /**
     * do paginate
     * @param  array   $where     condition
     * @param  integer $page      page of data
     * @param  integer $limit     limit per page
     * @param  string  $cols      columns to get
     * @param  string  $child_tbl child table
     * @param  [type]  $join      other tables
     * @return [type]             [description]
     */
    public static function paginate($where, $page = 1, $limit = 10, $cols = '*', $child_tbl = '', $join = [])
    {
        $page = intval($page);
        $limit = intval($limit);

        if ($limit < 10) {
            $limit = 10;
        }

        $tbl = self::getTable($child_tbl);
        if (!empty($join)) {
            $total = md()->count($tbl, $join, '*', $where);
        } else {
            $total = md()->count($tbl, $where);
        }

        self::chkErr();

        $page--;

        $count = ceil($total / $limit); //總頁數
        $page = max(0, (min($page, $count - 1))); //傳入頁數-1
        $where['LIMIT'] = [($page * $limit), $limit];

        // var_dump($where['LIMIT']);die();

        if (!empty($join)) {
            $res = md()->select($tbl, $join, $cols, $where);
        } else {
            $res = md()->select($tbl, $cols, $where);
        }

        self::chkErr();

        return [
            'rows' => $res,
            'total' => $total,
            'limit' => $limit,
            // 'page' => $count,
        ];
    }

    /**
     * get operating table
     * @param  string $child_tbl select the child table
     * @return string            table name
     */
    private static function getTable($child_tbl = '')
    {
        $that = get_called_class();

        $child = empty($child_tbl) ? '' : '_' . strtoupper($child_tbl);

        return constant($that . '::MT' . $child);
    }

    public static function getTableId($child_tbl = '')
    {
        $that = get_called_class();
        $list = self::TABLE_LIST;
        $child = empty($child_tbl) ? '' : '_' . $child_tbl;
        return $list[constant($that . '::MT' . $child)];
    }

    /**
     * get the primary key of selected table
     * @param  string $child_key select the child table primary key
     * @return string            primary key
     */
    private static function getKey($child_key = '')
    {
        $that = get_called_class();
        $child = empty($child_key) ? '' : '_' . $child_key;

        return constant($that . '::PK' . $child);
    }

    /**
     * check update or insert
     * @param  array   $data data
     * @param  string  $pk   primary key
     * @return boolean       update or insert
     */
    private static function is_update($data, $key)
    {
        $keyArr = explode(',', $key);
        if (is_array($data[0])) {
            return false;
        }
        foreach ($keyArr as $v) {
            $v = trim($v);
            if (!array_key_exists($v, $data)) {
                return false;
            }
        }
        return true;
    }

    /**
     * generate the update condition
     * @param  array  $data update data
     * @param  string $pk   primary key
     * @return array        condition
     */
    private static function parse($data, $pk)
    {
        $pkArr = explode(',', $pk);
        $rtn = [];
        foreach ($pkArr as $v) {
            $rtn[$v] = $data[$v];
        }
        return $rtn;
    }

    protected static function chkErr()
    {
        $err = md()->error();

        if (is_array($err) && $err[0] != '00000') {
            if (isDev()) {
                throw new \Exception(json_encode($err), 1);
                die();
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * encrypt & decrypt user tel
     * @param  string $act encrypt or decrypt
     * @param  string $tel tel
     * @return string      encrypted tel
     */
    public static function telCrypt($act, $tel)
    {
        $key = 101011;
        $tel = intval($tel);
        if ($act == 'encrypt') {
            $rtn = '0' . strval($tel + $key);
        } else {
            $rtn = '0' . strval($tel - $key);
        }

        return $rtn;
    }
}
