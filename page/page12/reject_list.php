<?php
    include '../../conf/config.php';
    use model\Reject;
    use model\Order;

    $oid = Input::get('sn');
    $date1 = Input::get('date1');
    $date2 = Input::get('date2');

    $list = Reject::find('all', getOptions());

    $rows = array();
    foreach ($list as $row) {
            $tmp = $row->attributes(true);
            // $tmp['status'] = Reject::getType($row->odr013);
            $rows[] = $tmp;
    }

    $OrderData = Order::find_by_odm001($oid);
    $order = $OrderData->attributes(true);
    // echo "<pre>"; print_r($order); echo "</pre>";
    $ooid = $order['oid'];
    $datecheck = explode(" ", $order['check_date']);

    // $tpl->assign('list',$list);
    $tpl->assign('oid',$oid);
    $tpl->assign('ooid',$ooid);
    $tpl->assign('datecheck',$datecheck[0]);
    $tpl->assign('date1',$date1);
    $tpl->assign('date2',$date2);
    $tpl->display('page12_reject_list.tpl');

    function getOptions() 
    {
        //雷達站帳號登入資訊
        $account = User::get('account');
        $name = User::get('name');
        $lv2Rid = User::get('id');

        $search_date2 = Input::post('date2');
        $today = date("Y-m-d");
        $oid = Input::post('oid');
        $no = Input::post('no');
        if($search_date2==$today){
             $date2 = date("Y-m-d", strtotime($search_date2."+1 day"));
        }else{
            $date2 = Input::post('date2');
        }
        
        $where = array();
        //搜尋一：只搜尋訂單編號 + 日期
        if (Input::post('no') && Input::post('date1') && Input::post('date2')) {
            $where[] = "odr005 = ? AND odr003 LIKE ? AND odr012 BETWEEN ? AND ?";
            $params[] = $lv2Rid;
            $params[] = "%".$no."%";
            $params[] = Input::post('date1');
            $params[] = $date2;
        //搜尋二：搜尋日期
        }elseif (!Input::post('no') && Input::post('date1') && Input::post('date2')) {
            $where[] = "odr005 = ? AND odr002 = ? AND odr012 BETWEEN ? AND ?";
            $params[] = $lv2Rid;
            $params[] = $oid;
            $params[] = Input::post('date1');
            $params[] = $date2;
        //搜尋二：搜尋訂單編號 
        }elseif (Input::post('no')) {
            $where[] = 'odr005 = ? AND odr003 LIKE ?';
            $params[] = $lv2Rid;
            $params[] = "%".$no."%"; 
        }


        $page = Input::post('page') ?: 1;
        $rp = Input::post('rp') ?: 10;
        $page = intval($page) ?: 1;
        $rp = intval($rp) ?: 10;

        $options = array(
            'offset' => ($page - 1) * $rp,
            'limit' => $rp,   
        );
        
        if ($where) {
            array_unshift($params, implode(' AND ', $where));
            $options['conditions'] = $params;
        }

        return $options;
    }

?>