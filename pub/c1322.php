<?php
// 會員清單

use model\Member;

class c1322 {

    public function run() {

        /* 目前頁數 */
        $page = Input::post('page') ?: 1;

        /* 結果 */
        $result = Member::find('all', $this->getOptions());
        // var_dump($this->getOptions());
        // exit;
        $rows = array();

        $cols = array('id', 'no', 'name', 'phone', 'qrcode', 'is_blacklist');

        foreach ($result as $row) {
            $tmp = $row->attributes($cols);
            $tmp['qrcode'] = $tmp['qrcode']
                ? Image::qrcodeUrl($tmp['qrcode'])
                : 0;
            $rows[] = $tmp;
        }

        return array(
            'page' => $page,
            'rows' => $rows,
            'total' => count(
                Member::find('all', $this->getOptions(true))
            ),
        );

    }

    private function getOptions($getCount = false)
    {
        $uid = User::get('id');
        $pid = Input::post('pid');
        $id = Input::post('id');
        $searchKind = Input::post('searchKind');
        $search = Input::post('search');

        if ($searchKind == 'no')
            $where[] = 'mem002 like ?';
        else if ($searchKind == 'name')
            $where[] = 'mem005 like ?';
        else /* phone */
            $where[] = 'mem011 like ?';


        $params[] = "%{$search}%";

        /* 啟用 = 0 , 停用 = 1 */
        $where[] = 'mem014 = ?';
        $params[] = 0;

        /* 雷達站 */
        $where[] = 'mem017 = ?';
        $params[] = $uid;

        $where[] = 'mem018 = ?';
        $params[] = 0;

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
            $options['order'] = 'mem001 DESC';
        }

        if ($where) {
            array_unshift($params, implode(' AND ', $where));
            $options['conditions'] = $params;
        }

        return $options;
    }

}