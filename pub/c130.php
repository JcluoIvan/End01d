<?php
// 黑名單

use model\Agent;
use model\Member;


class c130 {

    public function run() {

        /* 目前頁數 */
        $page = Input::post('page') ?: 1;

        // 結果
        $result = Member::with(
            Member::find('all', $this->getOptions()),
            array('radar')
        );

        $rows = array();

        // 變更索引值
        $cols = array('id', 'name', 'no', 'phone', 'blacklistDate', 'blacklistReason');

        foreach ($result as $row) {
            if (!$row)
                continue;
            $tmp = $row->attributes($cols);
            $tmp['ano'] = $row->radar ? $row->radar->age003 : '資料錯誤';
            $rows[] = $tmp;
        }

        return array(
            'page' => $page,
            'rows' => array_values($rows),
            'total' => count(
                Member::find('all', $this->getOptions(true))
            ),
        );
        
    }

    private function getOptions($getCount = false) 
    {
        $searchKind = Input::post('searchKind');
        $search = Input::post('search');

        /* 停用不顯示 */
        $where[] = 'mem014 = ?';
        $params[] = 0;
        
        /* 顯示黑名單 */
        $where[] = 'mem023 = ?';
        $params[] = 1;

        if ($searchKind == 'no') {
            $where[] = 'mem002 like ?';
        }
        else if ($searchKind == 'name') {
            $where[] = 'mem005 like ?';
        }
        else {
            $where[] = 'mem011 like ?';
        }

        $params[] = "%{$search}%";

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
            $options['order'] = 'mem024 DESC';
        }

        if ($where) {
            array_unshift($params, implode(' AND ', $where));
            $options['conditions'] = $params;
        }

        return $options;
    }
}