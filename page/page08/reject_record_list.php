<?php
    include '../../conf/config.php';
    use model\Reject;
    use model\Order;
    use model\Member;
    

    //登入的雷達站 ID
    $id = User::get('id');
    $sn = Input::get('sn');
    $date1 = Input::get('date1');
    $date2 = Input::get('date2');

    $list = Reject::find('all', getOptions());

    $rows = array();
    foreach ($list as $row) {
            $tmp = $row->attributes(true);
            // $tmp['status'] = Reject::getType($row->odr013);
            $rows[] = $tmp;
    }

    $member = Member::find_by_mem001($sn) ?: new Member;

    // $orderData = Order::find_by_odm001($oid);
    // $order = $orderData->attributes(true);
    // $ooid = $order['oid'];

    //$tpl->assign('list',$list);
    $tpl->assign('sn',$sn);
    $tpl->assign('member',$member);
    $tpl->assign('date1',$date1);
    $tpl->assign('date2',$date2);
    $tpl->display('page08_reject_record_list.tpl');

    function getOptions() 
    {
        //雷達站帳號登入資訊
        $account = User::get('account');
        $name = User::get('name');
        $lv2Rid = User::get('id');

        $sn = Input::post('sn');
        $no = Input::post('no');
        
        $where = array();
        if (!Input::post('no') && Input::post('date1') && Input::post('date2')) {
            $where[] = "odr005 = ? AND odr004 = ? AND YEAR(odr012) = ? AND MONTH(odr012) = ?";
            $params[] = $lv2Rid;
            $params[] = $sn;
            $params[] = Input::post('date1');
            $params[] = Input::post('date1');
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