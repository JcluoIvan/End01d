<?php
	include '../../conf/config.php';
	use model\Order;
	use model\Product;
    use model\Member;
    use model\Post;

	$sn = Input::get('sn') ?: 1501010001; // $_GET['oid'];

	// $list = Agent::find('all',array('order' => 'age001'));
	// $list = Agent::getallbylv('4');
	// $list = Order::getallOrders();
	// $list = Order::find('all', array('order' => 'odm006'));

	$orderData = Order::find_by_odm001($sn);

    $memberData = Member::find_by_mem001($orderData->odm013);

    // 鄉鎮市區
    $city = Post::row($orderData->odm016) ?: new Post;
    $country = Post::row($city->pos002) ?: new Post;
    $address2 = $city->pos004;
    $address1 = $country->pos004;
    $address = $address1.$address2.$orderData->odm017;

	// echo "<pre>"; print_r($orderData); echo "</pre>";
	$list = Order::getOrderDetail($sn);
	// echo "<pre>"; print_r($list); echo "</pre>";
	foreach ($list as $k) {
        //產品編號
        $data[] = $k->pid;
    }
    if(empty($data)){
        return false;
    }
    
    $options = array(
        'conditions' => array(
            'pdm001 in (?)',
            $data
        ),
    );
    $result = Product::find('all', $options) ?: array();
    // echo "<pre>"; print_r($result); echo "</pre>";

    $products = array();
    foreach ($result as $row) {
        $products[$row->pdm002] = $row;
        $pp[$row->pdm001] = $row->attributes();
    }
    // echo "<pre>"; print_r($pp); echo "</pre>";
    
    $rows = array();
    foreach ($list as $row) {
        $tmp = $row->attributes();
        $tmp['pname'] = isset($pp[$row->pid]['pdm001'])
            ? $pp[$row->pid]['pdm004'] 
            : ' ? ';
        $tmp['pno'] = $pp[$row->pid]['pdm002'];
        $rows[] = $tmp;
    }

	$j = 0;
	$sum = 0;
	$shoppinggold = 0;
	for ($i=1; $i<count($list)+1 ; $i++) { 
		$sum += $list[$j]->pmoney * $list[$j]->amount;
		$j++;
	}

	//本次使用的購物金
	$use_shoppinggold = $orderData->odm004 > 0 ? $orderData->odm004 : 0;

	//運費
	$shipment = $orderData->odm029;

    //退貨金
    $rmoney = $orderData->odm032;

	//實際金額
    $correct_sum = $sum - $use_shoppinggold + $shipment - $rmoney;

    //本次訂單新增的購物金
    $shoppinggold = floor($correct_sum*20/100);

    if($orderData->odm010=="csv"){
        $getMethods = "到店取貨";
    }elseif($orderData->odm010=="house"){
        $getMethods = "宅配";
    }

    switch ($orderData->odm018) {
        case 'donate':
            $invoice = '發票捐贈';
            break;
        case 'e-duplex':
            $invoice = '二聯式電子';
            break;
        case 'p-duplex':
            $invoice = '二聯式紙本';
            break;
        case 'triple':
            $invoice = '三聯式紙本';
            break;
        
        default:
            $invoice = '';
            break;
    }
	
	$tpl->assign('orderData',$orderData);
    $tpl->assign('memberData',$memberData);
	$tpl->assign('list',$list);
	$tpl->assign('product',$rows);
	$tpl->assign('sum',$sum);
	$tpl->assign('correct_sum',$correct_sum);
	$tpl->assign('shoppinggold',$shoppinggold);
    $tpl->assign('getMethods',$getMethods);
    $tpl->assign('address',$address);
    $tpl->assign('invoice',$invoice);
	$tpl->display('page12_order_detail.tpl');



?>