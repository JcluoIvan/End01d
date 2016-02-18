<?php
// 會員購買記錄 清單

use model\Member;
use model\Order;

class c530 {

    public function run() {

        /* 目前頁數 */
        $page = Input::post('page') ?: 1;

        $member = Member::find('first', $this->getMemberOptions()) ?: new Member;

        $mid = $member->mem001 ?: 0;

        $result = Order::find('all', $this->getOrderOptions($mid)) ?: new Order;

        $rows = array();
        
        foreach ($result as $row) {

            if (!$row) continue;
            
            $tmp = array();
            $tmp['oid'] = $row->odm001;
            $tmp['ono'] = $row->odm002;
            $tmp['verification_date'] = $row->odm005
                ? $row->odm005->format('Y-m-d') ?: ''
                : '';
            $tmp['trans_date'] = $row->odm006
                ? $row->odm006->format('Y-m-d') ?: ''
                : '';

            /* 總金額  = 實收 + 運費 + 使用購物金 - 退貨 */
            $tmp['money'] = intval($row->odm030) + intval($row->odm029) + intval($row->odm004) - intval($row->odm032);

            $rows[] = $tmp;
        }

        return array(
            'page' => $page,
            'rows' => $rows,
            'total' => count(
                Order::find('all', $this->getOrderOptions($member->mem001, true))
            ),
            'memberInfo' => array(
                'no' => $member->mem002 ?: null,
                'name' => $member->mem005 ?: null,
                'phone' => $member->mem011 ?: null,
            ),
        );
        
    }

    private function getMemberOptions()
    {
        $searchKind = Input::post('searchKind');
        $search = Input::post('search');

        if ($searchKind == 'no') {
            $where[] = 'mem002 = ?';
        }
        // else if ($searchKind == 'name') {
        //     $where[] = 'mem005 = ?';
        // }
        else {
            $where[] = 'mem011 = ?';
        }

        $params[] = $search;

        if ($where) {
            array_unshift($params, implode(' AND ', $where));
            $options['conditions'] = $params;
        }

        return $options;
    }

    private function getOrderOptions($mid, $getCount = false) 
    {
        $is_verification = Input::post('is_verification') ?: null;
        
        if ($is_verification == 'verification') {
            /* 核銷日期 */
            $where[] = 'odm005 NOT in(?) ';
            $params[] = "'null', '0000-00-00', ''";
        } else if ($is_verification == 'not_verification') {
            /* 未核銷 */
            $where[] = 'odm005 IS NULL';
        } else {
            /* 全部 */
            $where = array();
        }

        /* 該會員 */
        $where[] = 'odm013 = ?';
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
            $options['order'] = 'odm001 DESC';
        }

        if ($where) {
            array_unshift($params, implode(' AND ', $where));
            $options['conditions'] = $params;
        }

        return $options;
    }

}