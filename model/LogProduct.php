<?php
namespace model;
use ActiveRecord\Model;
use User;

class LogProduct extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'log_product';

    // explicit pk since our pk is not "id"
    static $primary_key = 'lpd001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $has_to = array(
        'product' => array('Product', 'pdm001', 'lpd003', 'single'),
        'editor' => array('Agent', 'age001', 'lpd002', 'single'),
    );

    static $attribute_transform = array(
        'lpd001' => 'id',
        'lpd002' => 'editor',
        'lpd003' => 'pid',
        'lpd004' => 'action',
        'lpd005' => 'content',
        'lpd006' => 'ip',
        'lpd007' => 'datetime',
    );

    static $validate_rules = array(
    );

    static $product_names = array(
        'pdm002' => '產品編號',
        'pdm003' => '類別',
        'pdm004' => '產品名稱',
        'pdm005' => '售價',
        'pdm006' => '會員價',
        'pdm007' => '上架狀態',
        'pdm008' => '影片路徑',
        'pdm009' => '使用方法',
        'pdm010' => '功效',
        'pdm013' => '是否為主力產品',
    );

    const ACTION_ADD = 'add';
    const ACTION_EDIT = 'edit';
    const ACTION_STATUS = 'status';

    static $actions = array(
        self::ACTION_ADD => '新增',
        self::ACTION_EDIT => '修改',
        self::ACTION_STATUS => '修改',
    );


    static function log(Product $product) 
    {
        return true;
        $update = $product->getUpdateAttribute();

        if (count($update) == 0) return true;

        $action = in_array('pdm001', array_keys($update))
            ? self::ACTION_ADD : self::ACTION_EDIT;

        $old = array();
        $new = array();

        foreach ($update as $column => $value) {

            if (! isset(static::$product_names[$column])) continue;

            if ($value instanceof \ActiveRecord\DateTime) {
                $old[$column] = $value->format('Y/m/d');
                $new[$column] = $product->$column->format('Y/m/d');
            } else {
                $old[$column] = $value;
                $new[$column] = $product->$column;
            }
        }

        if (count($new) == 0) return;

        if (count($new) == 1) {

            list($column) = array_keys($new);

            if (in_array($column, array('pdm007', 'pdm013'))) {
                $action = self::ACTION_STATUS;
            }

        }

        $log = new LogProduct;
        $log->lpd002 = User::get('id');
        $log->lpd003 = $product->pdm001;
        $log->lpd004 = $action;
        $log->lpd005 = json_encode(array('old' => $old, 'new' => $new));
        $log->lpd006 = User::ip();
        $log->save();

    }

    public function action() 
    {
        return static::$actions[$this->lpd004];
    }

    public function content() 
    {
        try {
            $json = json_decode($this->lpd005, true);
        } catch (\Exception $e) {
            return array( 
                'title' => '資訊錯誤',
                'old' => $this->lpd005,
                'new' => ''
            );
        }

        /* 單一屬性值的修改, 如：上、下架、主力產品 */
        if ($this->lpd004 == self::ACTION_STATUS) {
            list($column) = array_keys($json['new']);
            switch ($column) {
                case 'pdm007':
                    return $json['new']['pdm007'] ? '商品上架' : '商品下架';
                case 'pdm013':
                    return $json['new']['pdm013']
                        ? '設為主力產品'
                        : '設為非主力產品';
            }
        }

        $rows = array();
        foreach ($json['old'] as $column => $old) {

            if (! isset(static::$product_names[$column])) continue;

            $rows[] = array(
                'name' => static::$product_names[$column],
                'old' => $old,
                'new' => $json['new'][$column]
            );

        }

        return $rows;


    }


}

