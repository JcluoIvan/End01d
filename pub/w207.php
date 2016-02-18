<?php
use model\Member;

/**
 * 取得會員的下層
 */

class w207 {

    public function run()
    {

        $mid = intval(User::get('id'));

        $result = Member::find('all', $this->options($mid)) ?: array();
        $tree = array();
        $map = array();

        $columns = array('id', 'no', 'name');
        foreach ($result as $row) {
            $data = $row->attributes(array('id', 'name'));
            $data['name'] = mb_substr($data['name'], 0, 1) . '會員';
            $data['children'] = array();
            $map[$row->mem001] = $data;
            if (intval($row->mem020) == $mid) {
                $tree[] = &$map[$row->mem001];
            } else {
                $map[$row->mem020]['children'][] = &$map[$row->mem001];
            }
        }

        return array(
            'status' => true,
            'tree' => $tree,
        );
        
    }
    public function options($mid) {
        return array(
            'conditions' => array(
                '? IN (mem018, mem019, mem020) AND mem014 = 0',
                $mid
            ),
            'order' => 'mem018, mem019, mem020'
        );
    }
}