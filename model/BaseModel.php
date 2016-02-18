<?php
namespace model;
use Lang;
use Closure;
use ActiveRecord\Model;
use ActiveRecord\DatabaseException;
class BaseModel extends Model
{
    /**
     * 資料表欄位名稱的對應, 可填可不填,
     * 若有填寫, 在使用 model->attributes(true) 取得結果將會是轉換後的
     * @var array()
     *      例. array(col001 => id, col002 => name, ....)
     */
    static $attribute_transform = array();

    static $validate_rules = array();

    static $connection = 'production';

    /* 此 table 對多筆 */
    static $has_to = array();

    /* 此 table 所屬另一 table (例: detail.parent_id ) */
    // static $belongsTo = array();

    /* 以下變數為系統控制, 盡量非必要不要直接操作 */

    /* 軟刪除欄位 */
    static $soft_delete = '';

    protected $details = array();

    protected $source_attributes = array();

    protected $validates = array();

    protected $self_validates = array();

    protected $error = null;

    protected $errno = null;


    /* 以上變數為系統控制, 盡量非必要不要直接操作 */


    /**
     * 將資料轉成陣列 (複寫 ActiveRecord\Model 的 method)
     * 會將 static::$attribute_transform 對應的欄位名稱轉換
     * @param  boolean|array    $transform 
     *      false: (default) 不轉換, 以原欄位名稱輸出
     *      true: 轉換成對應的欄位名稱
     *      array(column1, column2, ....): 
     *          只轉換 & 回傳陣列的欄位名稱, (column1 為資料表的欄位名稱 
     * @return array( array )   轉成 array 的資料
     */
    public function attributes($transform = false) 
    {
        $row = parent::attributes();
        /*  判斷是否轉換欄位名稱 */
        if ($transform) {

            $attrs = array_merge(
                array_keys(static::$attribute_transform), 
                array_values(static::$attribute_transform)
            );

            $tf_row = array();

            foreach ($row as $key => $value) {

                /* 取得轉換後的欄位名稱 */
                $tkey = isset(static::$attribute_transform[$key])
                    ? static::$attribute_transform[$key]
                    : $key;

                /* 若為陣列, 則判斷欄位是否存在, 不存在則不處理 */
                if (
                    $transform === true || 
                    in_array($key, $transform) || 
                    in_array($tkey, $transform)
                ) {
                    if ($value instanceof \ActiveRecord\DateTime) {
                        $value = $value->format('Y/m/d H:i:s');
                    }

                    $tf_row[$tkey] = $value;
                }
            }
            $row = $tf_row;
        }
        return $row;
    }

    public static function with($rows, $params) 
    {
        $one = is_array($rows) ? false : true;
        if (empty($rows)) {
            return is_array($rows) ? array() : null;
        }
        /* 它層級的 with */
        $with_queue = array();

        foreach ($params as $name => $options) {
            if (! is_array($options) && ! is_callable($options)) {
                $name = $options;
                $options = array();
            }

            /* 處理多層級的 with */
            if (($idx = strpos($name, '.')) !== false) {
                $class = substr($name, 0, $idx);
                $name = substr($name, $idx + 1);
                if (! isset($with_queue[$class])) $with_queue[$class] = array();
                $with_queue[$class][$name] = $options;
                continue;
            } 

            $model = static::$has_to[$name][0];
            $d_key = static::$has_to[$name][1];
            $m_key = isset(static::$has_to[$name][2]) 
                ? static::$has_to[$name][2] : static::$primary_key;
            $is_single = isset(static::$has_to[$name][3]) &&
                static::$has_to[$name][3] === 'single';

            $details = array();
            $data = array();

            if (! $one) {
                foreach ($rows as $row) {
                    $data[] = $row->$m_key;
                    $details[$row->$m_key] = $is_single ? null : array();
                }
            } else {
                $details[$rows->$m_key] = $is_single ? null : array();
                $data = array($rows->$m_key);
            }
            $options = is_callable($options) ? $options() : $options;

            $where = isset($options['conditions']) 
                ? $options['conditions'] 
                : array();
            $where = is_array($where) ? $where : array($where);
            $where[0] = 
                (isset($where[0]) ? "{$where[0]} AND " : '') .
                "{$d_key} IN (?)";
            $where[] = $data;
            $options['conditions'] = $where;

            $method = "\\model\\{$model}::find";
            $result = call_user_func_array($method, array('all', $options)) ?: array();
            
            if ($is_single) {
                foreach ($result as $row) {
                    $details[$row->$d_key] = $row;
                }
            } else {
                foreach ($result as $row) {
                    $details[$row->$d_key][] = $row;
                }
            }
            if (! $one) {
                foreach ($rows as $row) {
                    $row->setJoinDetails($name, $details[$row->$m_key]);
                }
            } else {
                $rows->setJoinDetails($name, $details[$rows->$m_key]);
            }
        }

        if (count($with_queue)) {
            foreach ($with_queue as $name => $options) {
                $tmps = array();
                if (! $one) {
                    foreach ($rows as $row) {
                        if ($row->$name) $tmps[] = $row->$name;
                    }

                } else {
                    $tmps = $rows->$name;
                }
                if ($tmps) {
                    $class = $one ? get_class($tmps) : get_class($tmps[0]);
                    $class::with($tmps, $options);
                }
            }


        }


        return $rows;
    }

    /**
     * 複寫 save 動作, 這裡加入 validate, 以及錯誤攔截
     * @param  boolean $validate 是否做 validate
     * @return boolean           處理結果
     */
    public function save($do_validate = true) 
    {
        $result = true;
        if (method_exists($this, 'beforeSave')) {
            $result = call_user_func_array(array($this, 'beforeSave'), array());
        }

        ($do_validate) && $this->validates();

        // try {
            $result = parent::save($do_validate);
        // } catch (DatabaseException $e) {
        //     $this->errno = $e->getCode();
        //     $this->error = $e->getMessage();
        //     return false;
        // }
        method_exists($this, 'afterSave') && 
            call_user_func_array(array($this, 'afterSave'), array());

        $this->source_attributes = $this->attributes();
        return $result;
    }

    /**
     * 複寫 delete 動作
     * @param  boolean  $real   在有軟刪除的設定下, 是否做實體刪除
     * @return boolean           執行結果
     * 
     */
    public function delete($real = false) {
        
        $result = true;

        if (method_exists($this, 'beforeDelete')) {
            $result = call_user_func_array(array($this, 'beforeDelete'), array());
            if ($result !== true) return $result;
        }

        if (empty(static::$soft_delete) || $real) {
            $result = parent::delete();

        /* 軟刪除 */
        } else {
            $table = static::$table_name;
            $column = static::$soft_delete;
            $pkey = static::$primary_key;
            $this->$column = date('Y/m/d H:i:s');
            $sql = "UPDATE `{$table}` SET `{$column}` = ? WHERE `{$pkey}` = ?";
            $values = array(date('Y/m/d H:i:s'), $this->$pkey);
            $result = static::connection()->query($sql, $values);
        }


        ($result) && method_exists($this, 'afterDelete') &&
            call_user_func_array(array($this, 'afterDelete'), array());

        return $result;

    }

    /* 複寫 Model::find 動作 (為了軟刪除) */
    public static function find(/* $type, $options */) 
    {
        $column = static::$soft_delete;
        $args = func_get_args();

        /* 若有設定軟刪欄位, 查詢就要加上軟刪 */
        if (! empty($column)) {

            $args = func_get_args();
            if (empty($args[1]['soft'])) {
                $where = isset($args[1]['conditions']) ? $args[1]['conditions'] : array();
                $where = is_array($where) ? $where : array($where);
                $where[0] = "{$column} IS NULL " . 
                    ((empty($where[0]) ? '' : "AND {$where[0]}"));
                $args[1]['conditions'] = $where;
            } else {
                unset($args[1]['soft']);
                if (count($args[1]) == 0) unset($args[1]);
            }
        }
        return call_user_func_array('parent::find', $args);
    }

    /* 複寫 Model::count 動作 (為了軟刪除) */
    public static function count(/* ... */) 
    {

        $column = static::$soft_delete;
        $args = func_get_args();
        if (! empty($column)) {
            if (empty($args[0]['soft'])) {
                $where = isset($args[0]['conditions']) ? $args[0]['conditions'] : array();
                $where = is_array($where) ? $where : array($where);
                $where[0] = "{$column} IS NULL " . 
                    (empty($where[0]) ? '' : "AND {$where[0]}");
                $args[0]['conditions'] = $where;
            } else {
                unset($args[0]['soft']);
                if (count($args[0]) == 0) unset($args[0]);
            }
        }
        return call_user_func_array('parent::count', $args);

    }

    public function getErrNo() 
    {
        return $this->errno;
    }
    public function getError() 
    {
        return $this->error;
    }

    /**
     * 加入欄位檢查
     * @param string  $selector 若錯誤時, 顯示錯誤訊息的 element 
     * @param string  $column   傳入的欄位參數
     * @param Closure $closure  執行檢查匿名函數
     * @return class<Model> $this
     * ex:
     *     // use $agent 可將 $agent 傳入 function 內使用
     *     $agent->addValidate('[name=account]', 'age004', function($value) use ($agent) {
     *         return strlen($value) === 0
     *             ? '帳號不能為空值'
     *             : true
     *     });
     */
    public function addValidate($selector, $column, Closure $closure) {
        $this->self_validates[] = array(
            'selector' => $selector,
            'column' => $column,
            'rule' => $closure
        );
        return $this;
    }

    public function validates() 
    {
        
        $validates = array();

        $class_name = get_class($this);

        foreach (static::$validate_rules as $setting) 
        {
            foreach ($setting['rules'] as $key => $options) {

                $options = is_array($options) ? $options : array($options);

                $params = $options;

                array_unshift($params, $this->$setting['column']);

                isset($setting['message']) && 
                    $parent[] = $setting['message'];

                $method = 'validate' . ucfirst($key);
                
                $result = call_user_func_array(array($this, $method), $params);

                if ( $result !== true ) {
                    $selector = isset($setting['selector'])
                        ? $setting['selector'] : $column;

                    (! isset($validates[$selector])) 
                        && $validates[$selector] = array();
                    $validates[$selector][$key] = $result;
                }
            }
        }

        /* 處理額外加入的檢查 (@addValidate) */
        foreach ($this->self_validates as $setting) {

            isset($setting['message']) && 
                $parent[] = $setting['message'];

            $column = $setting['column'];            
            $result = call_user_func($setting['rule'],$this->$column);

            if ( $result !== true ) {
                $selector = isset($setting['selector'])
                    ? $setting['selector'] : $column;

                (! isset($validates[$selector])) 
                    && $validates[$selector] = array();
                $validates[$selector]["self_{$column}"] = $result;
            }
        }

        if (count($validates)) {
            header('Content-Type:text/json; charset=utf-8');
            exit(json_encode(array(
                'status' => false,
                'validates' => $validates
            )));
            
        }

    }
    /**
     * 取得更新的欄位
     * @return array() 回傳更新的欄位 & 原始值 array(column => value);
     */
    public function getUpdateAttribute() 
    {
        $new = $this->attributes();
        $old = $this->source_attributes;

        $updates = array();
        foreach($new as $col => $value) {
            $is_edit = false; 

            if ($value instanceof \ActiveRecord\DateTime &&
                $old[$col] instanceof \ActiveRecord\DateTime
            ) {

                $is_edit = $value->getTimestamp() != $old[$col]->getTimestamp();

            /* 若非 DateTime 則比較兩變數值是否相等 (DateTime 用 == 都會不相等) */
            } elseif ($old[$col] !== $value) {
                $is_edit = true;
            }
            if ($is_edit) $updates[$col] = $old[$col];
        }
        return $updates;
    }

    public function setJoinDetails($name, $rows) 
    {
        $this->details[$name] = $rows;
    }

    /* 產生邀請碼 */
    public function randInvitationCode() {

        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        
        $affix = ($this instanceof Agent) ? 'A' : 'M';

        $code = '';
        while (strlen($code) < 4) {
            $code .= $str[rand(0, 25)];
        }

        /* 類型(A, M) + 4 英文 + 3 數字 */
        return $affix . $code . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);

    }

    public function dateFormat($column, $format = 'Y-m-d') {
        return $this->$column ? $this->$column->format($format) : null;
    }

    public static function sort($column) {
        $table = static::$table_name;
        $sql = "UPDATE {$table} 
                SET {$column} = (@num := @num + 1) * 10
                ORDER BY {$column};";
        static::connection()->query('SET @num := 0;');
        static::connection()->query($sql);
    }
    public function &__get($name) 
    {
        if (isset(static::$has_to[$name])) {
            return $this->details[$name];
        }

        if (in_array("get_$name",static::$getters))
        {
            $name = "get_$name";
            $value = $this->$name();
            return $value;
        }

        return $this->read_attribute($name);
    }

    public function __isset($name) {
        if (isset(static::$has_to[$name])) {
            return ! empty($this->details[$name]);
        } else {
            return call_user_func_array('parent::__isset', array($name));
        }
    }

    public function __construct(array $attributes=array(), $guard_attributes=true, $instantiating_via_find=false, $new_record=true)
    {
        parent::__construct($attributes, $guard_attributes, $instantiating_via_find, $new_record);
        $this->source_attributes = $this->attributes();
    }

    public function validateRequired($value) 
    {
        return ! empty($value) 
            ? true
            : Lang::get('validate.required');
    }
    public function validateDate($value) 
    {
        return strtotime($value) > 0
            ? true
            : Lang::get('validate.date');
    }
    public function validateBetween($value, $min, $max) 
    {
        return is_numeric($value) && ($value >= $min) && ($value <= $max)
            ? true
            : sprintf(Lang::get('validate.between'), $min, $max);
    }
    public function validateEmail($value) 
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL)
            ? true
            : Lang::get('validate.email');
    }
    public function validateInteger($value) 
    {
        return filter_var($value, FILTER_VALIDATE_INT)
            ? true
            : Lang::get('validate.integer');
    }
    public function validateNumber($value)
    {
        return is_numeric($value)
            ? true
            : Lang::get('validate.number');
    }
    public function validateExists(
        $value, 
        $table, 
        $column, 
        $where = null, 
        $params = array()
    ) {
        $where .= ($where === null ? '' : " AND ") . "{$column} = ? ";
        $sql = "SELECT COUNT(1) AS count FROM {$table} WHERE {$where} ";
        list($row) = static::find_by_sql($sql, array_merge($params, array($value)));
        return $row->count > 0
            ? true
            : Lang::get('validate.exists');
    }
    public function validateUnique($value, $table, $column, $not_column, $err = null) {
        $where = "{$column} = ? AND {$not_column} != ?";
        $sql = "SELECT COUNT(1) AS count FROM {$table} WHERE {$where} ";
        list($row) = static::find_by_sql($sql, array($value, $this->$not_column ?: 0));
        return $row->count == 0
            ? true
            : Lang::get('validate.unique');
    }
    public function validateIn($value/*, item1, item2 .... */) 
    {
        $list = array_slice(func_get_args(), 1);
        return in_array($value, $list)
            ? true
            : sprintf(Lang::get('validate.in'), implode(', ', $list));
    }
    public function validateLength($value, $min, $max) 
    {
        return (mb_strlen($value) >= $min) && (mb_strlen($value) <= $max)
            ? true
            : sprintf(Lang::get('validate.length'), $min, $max);
    }
}

