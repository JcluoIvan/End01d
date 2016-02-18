<?php
// 主管 會計 廠務 客服 清單

use model\Agent;

// var_dump($_POST);

class c100 {

    public function run() {

        /* 目前頁數 */
        $page = Input::post('page') ?: 1;

        $result = Agent::find('all', $this->getOptions());
        
        $rows = array();

        $cols = array('id', 'utp', 'no', 'account', 'name', 'is_disabled');

        foreach ($result as $row) {
            $tmp = $row->attributes($cols);
            $tmp['type'] = Agent::getCorrespondTypes($tmp['utp']);
            $rows[] = $tmp;
        }

        return array(
            'page' => $page,
            'rows' => $rows,
            'total' => count(
                Agent::find('all', $this->getOptions(false))
            ),
        );
        
    }

    private function getOptions($getCount = true) 
    {
        $searchKind = Input::post('searchKind');
        $search = Input::post('search');

        // no 否則 name
        $where[] = $searchKind == 'no' 
            ? 'age003 like ?' 
            : 'age006 like ?';

        $params[] = "%{$search}%";

        $where[] = 'age002 in(?)';
        $params[] = array('S', 'A', 'P', 'C');

        /* 目前頁數 */
        $page = Input::post('page') ?: 1;

        /* 每頁筆數 */
        $rp = Input::post('rp') ?: 10;

        $page = intval($page) ?: 1;
        $rp = intval($rp) ?: 10;

        $options = array();
        if ($getCount) {
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;
            $options['order'] = 'age001 DESC';
        }

        if ($where) {
            array_unshift($params, implode(' AND ', $where));
            $options['conditions'] = $params;
        }

        return $options;
    }

}