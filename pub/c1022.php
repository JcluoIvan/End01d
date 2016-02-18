<?php
// 客服記錄 清單

use model\Dialogue;
use model\Member;

class c1022 {

    public function run() 
    {
        /* 目前頁數 */
        $page = Input::post('page') ?: 1;

        $mid = Input::post('mid');

        $member = Member::find_by_mem001($mid) ?: new Member;

        // 結果
        $result = Dialogue::with(
            Dialogue::find('all', $this->getOptions()),
            array('customer')
        );

        $rows = array();

        // 變更索引值
        $cols = array('id', 'mid', 'aid', 'content', 'datetime');

        foreach ($result as $row) {
            if (!$row)
                continue;
            $tmp = $row->attributes($cols);
            $tmp['ano'] = $row->customer ? $row->customer->age003 : '資料錯誤';
            $rows[] = $tmp;
        }

        return array(
            'page' => $page,
            'rows' => array_values($rows),
            'total' => count(
                Dialogue::find('all', $this->getOptions(true))
            ),
            'member' => array(
                'no' => $member->mem002 ?: '',
                'name' => $member->mem005 ?: '',
                'phone' => $member->mem011 ?: '',
            ),
        );
    }

    private function getOptions($getCount = false) 
    {
        /* 停用不顯示 */
        $mid = Input::post('mid');

        $where[] = 'dia002 = ?';
        $params[] = $mid;

        /* 目前頁數 */
        $page = Input::post('page') ?: 1;

        /* 每頁筆數 */
        $rp = Input::post('rp') ?: 10;

        $page = intval($page) ?: 1;
        $rp = intval($rp) ?: 10;

        $options = array();
        if (!$getCount) {
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;
            $options['order'] = 'dia005 DESC';
        }

        if ($where) {
            array_unshift($params, implode(' AND ', $where));
            $options['conditions'] = $params;
        }

        return $options;
    }

}