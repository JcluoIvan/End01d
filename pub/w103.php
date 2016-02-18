<?php
use model\Product;
use model\ProductPhoto;
/* 取得產品詳細資料 */

class w103 {

    public function run() {

        $black = User::get('black');
        $pid = Input::post('pid');
        $pid = is_array($pid) ? $pid : array($pid);

        $options = array(
            'conditions' => array('pdm001 IN (?) AND pdm007 = 1', $pid )
        );
    
        $result = Product::with(
            Product::find('all', $options),
            array(
                'photo' => array('conditions' => 'pdo004 = 1'),
                'sgs' => array('conditions' => 'pdo004 = 2'),
                'edm' => array('conditions' => 'pdo004 = 3'),
                'item' => array(),
                'video' => array(),
            )
        );

        $rows = array();
        $columns = array(
            'id', 'no', 'type', 'name', 'price', 'member_price',
            'video', 'how_use', 'capacity', 'main', 'introduce',
            'element', 'suit', 'sell_type',
        );
        foreach ($result as $row) {
            $tmp = $row->attributes($columns);
            $tmp['imgs'] = array_map(
                function($o) { return $o->getMinImageUrl(); }, 
                $row->photo
            );
            $tmp['sgs'] = array_map(
                function($o) { return $o->getMinImageUrl(); }, 
                $row->sgs
            );
            $tmp['edm'] = array_map(
                function($o) { return $o->url(); },
                $row->edm
            );

            $tmp['introduce'] = $tmp['introduce'];
            $tmp['how_use'] = $tmp['how_use'];
            $tmp['suit'] = $tmp['suit'];
            $tmp['element'] = $tmp['element'];
            $tmp['video'] = array_map(function($video) {
                return $video->attributes(array('title', 'no'));
            }, $row->video);
            $tmp['type_name'] = $row->item ? $row->item->pdi002 : ' ? ';
            $tmp['caption'] = '';
            $tmp['OOS'] = $black;   /* 是否缺貨 (若為黑名單一率為缺貨) */
            $rows[] = $tmp;
        }

        return array(
            'status' => true,
            'rows' => $rows
        );

    }

}