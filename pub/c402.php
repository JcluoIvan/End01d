<?php
use model\Member;
use model\Agent;
/* 推播的指揮、雷達站、會員清單 */
class c402 {

    public function run() {
        $for = Input::post('notice_for');
        switch($for) {
            case 'agent-l':
                return $this->agentRows('L');
            case 'agent-r':
                return $this->agentRows('R');
            default:
                return $this->memberRows();
        }
        
    }
    public function page() {
        return Input::post('page') ?: 1;
    }
    public function rp() {
        return Input::post('rp') ?: 10;
    }
    public function memberRows() 
    {

        $rows = array();

        $result = Member::find('all', $this->memberOptions());

        $columns = array('id', 'no', 'name', 'phone');

        foreach ($result as $row) {
            $rows[] = $row->attributes($columns);
        }

        return array(
            'page' => $this->page(),
            'rows' => $rows,
            'total' => Member::count($this->memberOptions(true)),
        );
        
    }
    public function memberOptions($is_count = false) 
    {

        /* 目前頁數 */
        $page = $this->page();

        /* 每頁筆數 */
        $rp = $this->rp();

        /* 過濾被停用的帳號 */
        $conditions = array('');
        $where = array('mem014 = 0');

        /* 查詢姓名 or 編號 */
        $query = Input::post('query_text');

        if (strlen($query)) {
            $where[] = Input::post('query_type') == 'phone'
                ? 'mem011 LIKE ?'
                : 'mem005 LIKE ?';
            $conditions[] = "%{$query}%";
        }
        $conditions[0] = implode(' AND ', $where);
        $options = array(
            'conditions' => $conditions
        );


        if (! $is_count) {
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;
            $options['order'] = 'mem001';
        }
        return $options;

    }

    public function agentRows($type) 
    {

        $rows = array();

        $result = Agent::find('all', $this->agentOptions($type));

        $columns = array('id', 'no', 'name', 'phone');

        foreach ($result as $row) {
            $rows[] = $row->attributes($columns);
        }

        return array(
            'page' => $this->page(),
            'rows' => $rows,
            'total' => Agent::count($this->agentOptions($type, true)),
        );
        
    }
    public function agentOptions($type, $is_count = false) 
    {

        /* 目前頁數 */
        $page = $this->page();

        /* 每頁筆數 */
        $rp = $this->rp();

        $conditions = array('', $type);
        $where = array('age016 = 0 AND age002 = ?');

        $query = Input::post('query_text');
        $type = Input::post('query_type');

        if ($query) {
            if ($type === 'phone') {
                $where[] = '(age012 = ? OR age004 = ?)';
                $conditions[] = "%{$query}%";
                $conditions[] = "%{$query}%";
            } else {
                $where[] = 'age005 = ?';
                $conditions[] = "%{$query}%";
            }
        }
        $conditions[0] = implode(' AND ', $where);
        $options = array('conditions' => $conditions);

        if (! $is_count) {
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;
            $options['order'] = 'age001';
        }
        return $options;

    }

}