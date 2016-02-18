<?php
namespace model;

class IncreaseModel extends \ArrayObject{

    protected $has_to = null;
    
    /**
     * 查詢關聯的 table 
     * name 為關聯的名稱, conditions 為關聯時的追加條件, 可省略
     * @param  array() $data 
     *         array(
     *             [name => conditions | name ],
     *             ......
     *         )
     * @return array<Model> 
     */
    public function with($data) 
    {

        $rows = $this->getArrayCopy();

        if (count($rows) === 0) return array();

        foreach ($data as $name => $options) {
            $params = null;
            if (is_array($options)) {
                $params = $this->has_to[$name];
            } else {
                $name = $options;
                $options = '';
                $params = $this->has_to[$name];
            }

            $rows = $this->getDetailRows(
                $rows, 
                $name, 
                $params[0],
                $params[1],
                $params[2],
                $params[3] === 'single',
                $options
            );
        }
        return $rows;
    }
    /**
     * 關聯資料
     * @param  array<Model> $rows   要處理的 model 陣列
     * @param  string       $name   名稱
     * @param  string       $detail_model 關聯的 Model Name
     * @param  string       $d_key        關聯的 Model Name 的 key id
     * @param  string       $m_key        主檔的 Model Name 的 key id
     * @param  boolean      $is_single    是否為 1 對 1 關聯
     * @param  array        $where        追加條件, 格式同 conditions => array(...)
     * @return array<Model>     關聯後的陣列
     */
    protected function getDetailRows(
        $rows, 
        $name, 
        $detail_model, 
        $d_key, 
        $m_key, 
        $is_single,
        $where = null
    ) {
        $ids = array();
        $details = array();
        $mapping = array();
        foreach ($rows as $row) {
            $ids[] = $row->$m_key;
            $details[$row->$m_key] = $is_single ? null : array();
            $mapping[$row->$m_key] = $row;
        }
        $options = array('conditions' => array("{$d_key} IN(?)", $ids) );
        if ($where) {
            $options['conditions'][0] .= ' AND ' . array_shift($where);
            $options['conditions'] = array_merge($options['conditions'], $where);
        }
        $method = "\\model\\{$detail_model}::find";
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
        foreach ($mapping as &$row) {
            $row->setHasManyDetails($name, $details[$row->$m_key]);
        }
        return array_values($mapping);
    }
    public function __construct() 
    {
        $args = func_get_args();
        $class = array_shift($args);
        $class = "\\{$class}";
        $this->has_to = array_shift($args);

        call_user_func_array('parent::__construct', $args);

    }
}