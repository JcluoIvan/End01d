<?php
use model\Product;
use model\ProductPhoto;
/* 取得某分類下的產品清單 */
class w102 
{

    public function run() 
    {

        $result = Product::with(
            Product::find('all', $this->options()),
            array('photo' => array('conditions' => 'pdo004 = 1'))
        );

        $rows = array();
        foreach ($result as $row) {
            $tmp = $row->attributes(array('id', 'no', 'name', 'sort'));
            $tmp['img'] = array();
            foreach($row->photo as $p) {
                $tmp['img'][] = $p->getMinImageUrl();
            }
            $rows[] = $tmp;
        }

        return array(
            'status' => true,
            'rows' => $rows,
            'total' => Product::count($this->options(true))
        );

    }
    public function rp() 
    {
        return 15;
    }
    public function options($is_count = false) 
    {
        $iid = Input::post('item_id');
        if ($sort = Input::post('last_sort')) {
            $options = array(
                'conditions' => array(
                    'pdm007 = 1 AND pdm003 = ? AND pdm014 > ?',
                    $iid,
                    $sort
                )
            );
        } else {
            $options = array(
                'conditions' => array(
                    'pdm007 = 1 AND pdm003 = ?',
                    $iid
                )
            );
        }

        if (! $is_count) {
            $options['offset'] = Input::post('count') ?: 0;
            $options['limit'] = $this->rp();
            $options['order'] = 'pdm014';
        }
        return $options;



    }
}