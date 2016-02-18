<?php
use model\Agent;
use model\RadarStatement;
use model\Order;
// use model\Reject;
// use model\Swap;

class c310 {

    public function run() {

        $page = Input::post('page') ?: 1;
        $rows = array();
        $options = array(
            'conditions' => array(
                'age002 = ?', 
                'R'
            )
        );

        $rp = Input::post('rp') ?: 10;
        $options['offset'] = ($page - 1) * $rp;
        $options['limit'] = $rp;
        // $options['order'] = 'age001 ASC';
        
        $result = Agent::with(
            Agent::find('all', $this->getOptions()),
            array(
                'order' => $this->orderOptions(),
                'rstatement' => $this->radarOptions(),
            )
        );
        
        $count = Agent::count($this->getOptions(true));

        foreach ($result as $row) {
            $tmp = $row->attributes(true);
            $rstatement = $row->rstatement ?: new RadarStatement;
            $order = $row->order ?: new Order;
            $tmp['total1'] = is_array($row->order) && count($row->order) 
                ? $row->order[0]->total - $row->order[0]->rejecttotal : 0;
            $tmp['fare'] = is_array($row->order) && count($row->order) 
                ? $row->order[0]->fare : 0;
            $tmp['total'] = $tmp['total1'];
            $tmp['rtotal'] = is_array($row->rstatement) && count($row->rstatement) 
                ? $row->rstatement[0]->rtotal : 0; 
            $tmp['DateCheck'] = is_array($row->rstatement) && count($row->rstatement) 
                ? $rstatement[0]->datecheck : null;
            $tmp['users'] = is_array($row->rstatement) && count($row->rstatement) 
                ? $rstatement[0]->users : null;
            $rows[] = $tmp;
        }
        
        return array(
            'page' => $page,
            'rows' => $rows,
            'total' => $count,
        );        
        // $sql = Agent::connection()->last_query; 
    }

    private function orderOptions(){

            $where = array();
            $data = array();
            $chekDate = '0000-00-00';

            if (
                ($date1 = Input::post('date1')) && 
                ($date2 = Input::post('date2'))
            ) {
                // $where[] = '( YEAR(odm006) = ? AND MONTH(odm006) = ?)';
                $where[] = 'odm005 > ? AND odm005 BETWEEN ? AND ?';
                $data[] = $chekDate;
                $data[] = $date1;
                $data[] = $date2;
            }

            $where = implode(' AND ', $where);
            $options = array(
                'select' => implode(',', array(
                    'SUM(odm029) AS fare',
                    'SUM(odm030) AS total',
                    'SUM(odm032) AS rejecttotal',
                    'odm022'
                )),
                'conditions' => array_merge(array($where), $data),
                'group' => 'odm022'
            );

            return $options;
    }

    private function radarOptions(){

            $where = array();
            $data = array();
            
            $search_date2 = Input::post('date2');
            $today = date("Y-m-d");
            if($search_date2==$today){
                $date3 = date("Y-m-d", strtotime($search_date2."+1 day"));
            }else{
                $date3 = Input::post('date2');
            }

            if (
                ($date1 = Input::post('date1')) && 
                ($date2 = $date3)
            ) {
                // $where[] = '( YEAR(rat004) = ? AND MONTH(rat004) = ?)';
                $where[] = 'rat004 BETWEEN ? AND ?';
                $data[] = $date1;
                $data[] = $date2;
            }

            $where = implode(' AND ', $where);
            $options = array(
                'select' => implode(',', array(
                    'SUM(rat003) AS rtotal',
                    'rat004 as dateCheck',
                    'rat005 as users',
                    'rat002'
                )),
                'conditions' => array_merge(array($where), $data),
                'group' => 'rat002'
                
            );
            return $options;
    }

    private function getOptions($is_count = false)
    {
        
        $where = array();
        $type = 'R';
        
        //搜尋：搜尋雷達站編號或名稱
        if (Input::post('no')) {
            $where[] = 'age002 = ? AND (age003 LIKE ? OR age004 LIKE ? OR age006 LIKE ?)';
            $params[] = "'{$type}'"; 
            $params[] = "%".Input::post('no')."%";
            $params[] = "%".Input::post('no')."%";
            $params[] = "%".Input::post('no')."%";
        }

        $page = Input::post('page') ?: 1;
        $rp = Input::post('rp') ?: 10;
        $page = intval($page) ?: 1;
        $rp = intval($rp) ?: 10;

        if (! $is_count) {
            $options = array(
                'conditions' => array(
                    'age002 = ?', 
                    'R'
                ),
                'offset' => ($page - 1) * $rp,
                'limit' => $rp,   
            );
        }else{
            $options = array(
                'conditions' => array(
                    'age002 = ?', 
                    'R'
                ),   
            );
        }
        
        if ($where) {
            array_unshift($params, implode(' AND ', $where));
            $options['conditions'] = $params;
        }
        
        return $options;
    }

}