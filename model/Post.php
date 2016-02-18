<?php
namespace model;
use ActiveRecord\Model;

class Post extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'post';

    // explicit pk since our pk is not "id"
    static $primary_key = 'pos001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $attribute_transform = array(
        'pos001' => 'id',
        'pos002' => 'pid',
        'pos003' => 'code',
        'pos004' => 'name',
    );

    static $cache = null;

    public static function loadData() {
        $options = array(
            'conditions' => 'pos005 = 0',
            'order' => 'pos002, pos001'
        );
        $rows = static::find('all', $options);

        static::$cache = array();

        foreach ($rows as $row) {
            $id = $row->pos001;
            $pid = $row->pos002;

            (! isset(static::$cache[$id])) && 
                static::$cache[$id] = array('row' => null, 'children' => array());

            static::$cache[$id]['row'] = $row;

            (! isset(static::$cache[$pid])) && 
                static::$cache[$pid] = array('row' => null, 'children' => array());

            static::$cache[$pid]['children'][] =& static::$cache[$id]['row'];

        }

    }

    public static function rows($pid = 0, $key_by_id = false) 
    {
        (static::$cache === null) && static::loadData();

        $target = isset(static::$cache[$pid]) ? static::$cache[$pid] : array();

        if (! $key_by_id) return $target['children'];

        $rows = array();

        foreach ($target['children'] as $row) {
            $rows[$row->pos001] = $row['row'];
        }
        return $rows;
    }

    public static function row($id, $default = null) {
        (static::$cache === null) && static::loadData();
        return isset(static::$cache[$id]) 
            ? static::$cache[$id]['row'] : $default;
    }


    public static function optionCountrys() 
    {
        $rows = array();
        foreach (static::rows() as $row) {
            if ($row->pos002 > 0) continue;
            $rows[$row->pos001] = $row->pos004;
        }
        return $rows;
    }
    public static function optionCitys() 
    {
        $rows = array();
        foreach (static::rows() as $row) {
            if ($row->pos002 == 0) continue;
            (! isset($rows[$row->pos002])) && $rows[$row->pos002] = array();
            $rows[$row->pos002][$row->pos001] = $row->pos004;
        }
        return $rows;
    }

    public static function allArray() 
    {
        (static::$cache === null) && static::loadData();

        $tree = array();
        $columns = array('id', 'pid', 'code', 'name');
        foreach (static::rows() as $row) {
            $data = $row->attributes($columns);
            $data['children'] = array();
            foreach (static::rows($row->pos001) as $ch) {
                $data['children'][] = $ch->attributes($columns);
            }
            $tree[] = $data;
        }
        return $tree;
    }

}

