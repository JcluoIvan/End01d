<?php
use model\Order;
use model\Reject;
use model\Swap;
use model\Agent;

class c804 extends pub\GatewayApi{

    public function run() {
        
        //雷達站帳號登入資訊
        $account = User::get('account');
        $name = User::get('name');
        $lv2Rid = User::get('id');

        // $count = News::count()
        $page = Input::post('page') ?: 1;
        
        // $result = Order::getPage($page);
        $rows = array();
        $result = Order::find('all', $this->getOptions());
        $sql = Order::connection()->last_query;
        $count = intval(Order::count($this->getOptions(true)));
        
        foreach ($result as $row) {
            $tmp = $row->attributes(true);
            // $tmp['check_status'] = $row->odm005 ? $row->odm005 : null;
            $tmp['methods'] = Order::getMethods($row->odm009);
            $tmp['getmode'] = Order::getMode($row->odm010);

            //檢查換貨資料表是否有相同的訂單編號
            $swap = Swap::getOrderForSwap($row->odm001) ?: null;
            // $swap = Swap::getOrderForSwap($row->getOid()) ?: null;
            $tmp['swap'] = $swap ? $swap->ods001 : 0;

            //檢查退貨資料表是否有相同的訂單編號
            $reject = Reject::getOrderForReject($row->odm001) ?: null;
            // $reject = Reject::getOrderForReject($row->getOid()) ?: null;
            $tmp['reject'] = $reject ? $reject->odr002 : 0;

            //指揮站編號
            $agentL = Agent::find_by_age001($tmp['lv1id']) ?: null;
            $tmp['lv1id'] = $agentL ? $agentL->age003 : null;

            //雷達站編號
            $agentR = Agent::find_by_age001($tmp['lv2id']) ?: null;
            $tmp['lv2id'] = $agentR ? $agentR->age003 : null;

            $tmp['check_date'] = $row->odm005 ? $row->odm005->format('Y-m-d') : '';
            $tmp['date1'] = $row->odm006 ? $row->odm006->format('Y-m-d') : '';
            $tmp['date2'] = $row->odm007 ? $row->odm007->format('Y-m-d') : '';
            $tmp['date3'] = $row->odm008 ? $row->odm008->format('Y-m-d') : '';
            $tmp['coupon_date'] = $row->odm031 ? $row->odm031->format('Y-m-d') : '';

            $date1 = explode(" ", $tmp['date1']);
            $tmp['date1'] = $date1[0];
            $checkDate = explode(" ", $tmp['check_date']);
            $tmp['check_date'] = $checkDate[0];
            $date2 = explode(" ", $tmp['date2']);
            $tmp['date2'] = $date2[0];
            $date3 = explode(" ", $tmp['date3']);
            $tmp['date3'] = $date3[0];

            //現金
            $tmp['cash'] = $tmp['total'] - $tmp['fare'];

            //應收金額
            $tmp['total2'] = $tmp['cash'] + $tmp['fare'] - $tmp['coupon'] - $tmp['reject_shopgold'];
            
            $rows[] = $tmp;
        }

        return array(
            'page' => $page,
            'rows' => $rows,
            'total' => $count,
        );
        
    }

    private function getOptions($is_count = false) 
    {
        //雷達站帳號登入資訊
        $account = User::get('account');
        $name = User::get('name');
        $lv2Rid = User::get('id');
        $search = Input::post('search');
        $phone = Input::post('no');
        $memberID = $this->findMember($phone);
        $search_date2 = Input::post('date2');
        $today = date("Y-m-d");
        if($search_date2==$today){
            $date2 = date("Y-m-d", strtotime($search_date2."+1 day"));
        }else{
            $date2 = Input::post('date2');
        }

        if(Input::post('no')){
            switch ($search) {
                case 'oid':
                    $where = array(
                        'odm022 = ? AND (odm006 BETWEEN ? AND ?) AND odm002 LIKE ?', 
                        $lv2Rid,
                        Input::post('date1'),
                        Input::post('date2'),
                        "%".Input::post('no')."%"
                    );
                    break;

                case 'mid':
                    $where = array(
                        'odm022 = ? AND (odm006 BETWEEN ? AND ?) AND odm013 IN (?)', 
                        $lv2Rid,
                        Input::post('date1'),
                        Input::post('date2'),
                        $memberID,
                    );
                    break;
                
                case 'name':
                    $where = array(
                        'odm022 = ? AND (odm006 BETWEEN ? AND ?) AND odm014 LIKE ?', 
                        $lv2Rid,
                        Input::post('date1'),
                        Input::post('date2'),
                        "%".Input::post('no')."%",
                    );
                    break;

                case 'phone':
                    $where = array(
                        'odm022 = ? AND (odm006 BETWEEN ? AND ?) AND odm013 IN (?)', 
                        $lv2Rid,
                        Input::post('date1'),
                        $date2,
                        $memberID,
                    );
                    break;
                default:
                    # code...
                    break;
            }
        }else{
            $where = array(
                'odm022 = ? AND (odm006 BETWEEN ? AND ?) ', 
                $lv2Rid,
                Input::post('date1'),
                Input::post('date2'),
            );
        }

        $options = array(
            'conditions' => $where,
        );
        
        $page = Input::post('page') ?: 1;
        $rp = Input::post('rp') ?: 10;
        $page = intval($page) ?: 1;
        $rp = intval($rp) ?: 10;

        if(!$is_count){
            $options['offset'] = ($page - 1) * $rp;
            $options['limit'] = $rp;
            $options['order'] =  'odm001 DESC';
        }
        return $options;

    }

}