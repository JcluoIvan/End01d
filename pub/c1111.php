<?php
// 指揮 雷達 清單

/* 
    pid = 上層id;
    有 pid 顯示指揮站清單，否則顯示雷達站清單
*/

use model\Agent;
use model\Member;

// echo "<pre>";
// var_dump($_POST);


class c1111 {

    public function run() {

        /* 目前頁數 */
        $page = Input::post('page') ?: 1;

        $pid = Input::post('pid');

        // 結果
        $result = Agent::with(
            Agent::find('all', $this->getOptions()),
            array('bank')
        );

        $rows = array();
        $pid_array = array();

        // 變更索引值
        $cols = array(
            'id', 
            'no', 
            'name', 
            'phone', 
            'qrcode', 
            'qrcodeId', 
            'bank_code', 
            'bank_account', 
            'is_disabled', 
            'is_public',
            'is_locked',
        );

        foreach ($result as $row) {
            $tmp = $row->attributes($cols);
            $tmp['qrcode'] = $row->getQRCodeUrl();
            $tmp['qrcodeId'] = $tmp['qrcodeId'] ?: false;
            $tmp['bank_name'] = is_object($row->bank) ? $row->bank->ban002 : null;
            $tmp['bank_code'] = "{$tmp['bank_code']} - {$tmp['bank_name']}";
            $pid_array[] = $tmp['id'];
            $rows[$tmp['id']] = $tmp;
            $rows[$tmp['id']]['layers'] = 0;
        }

        if ($pid_array) {
            // 雷達站下層數 否則 指揮站下層數
            $layers = $pid 
                ? $this->getRAgentLayers($pid_array) 
                : $this->getLAgentLayers($pid_array);

            foreach ($layers as $row) {
                $rows[$row->pid]['layers'] = $row->cnt;
            }
        }


        return array(
            'page' => $page,
            'rows' => array_values($rows),
            'total' => count(
                Agent::find('all', $this->getOptions(true))
            ),
        );
        
    }

    private function getOptions($getCount = false) 
    {
        $pid = Input::post('pid');
        $id = Input::post('id');
        $searchKind = Input::post('searchKind');
        $search = Input::post('search');

        if ($searchKind == 'no')
            $where[] = 'age003 like ?';
        else if ($searchKind == 'name')
            $where[] = 'age006 like ?';
        else /* phone */
            $where[] = 'age012 like ?';

        $params[] = "%{$search}%";

        if ($pid) {
            $where[] = 'age018 = ?';
            $params[] = $pid;
        } else {
            $where[] = 'age002 = ?';
            $params[] = 'L';
        }

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
            $options['order'] = 'age001 DESC';
        }

        if ($where) {
            array_unshift($params, implode(' AND ', $where));
            $options['conditions'] = $params;
        }

        return $options;
    }

    public function getLAgentLayers($pid)
    {
        $options = array(
            'select' => 
                'COUNT(age001) AS cnt, age018 AS pid',

            'conditions' => array(
                'age002 = ? AND age018 in(?)',
                'R', $pid,
            ),
            'group' => 'age018',
        );

        return Agent::find('all', $options);
    }

    public function getRAgentLayers($pid_array) 
    {
        $options = array(
            'select' =>
                'COUNT(mem001) AS cnt, mem017 AS pid',

            'conditions' => array(
                'mem014 = ? AND  mem017 in (?)', 0, $pid_array,
            ),
            'group' => 'mem017',
        );

        return Member::find('all', $options);
    }

}