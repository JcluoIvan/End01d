<?php
    include '../../conf/config.php';
    use model\Order;
    use model\OrderDetail;
    use model\Product;
    use model\Member;
    use model\Post;
    use model\Receipt;
    use model\Image;
    use model\Reject;

    $sn = Input::get('sn') ?: 1501010001; // $_GET['oid'];

    $orderData = Order::find_by_odm001($sn);
    
    $list = Order::getOrderDetail($sn);

    $memberData = Member::find_by_mem001($orderData->odm013);


    // 鄉鎮市區
    $city = Post::row($orderData->odm016) ?: new Post;
    $country = Post::row($city->pos002) ?: new Post;
    $address2 = $city->pos004;
    $address1 = $country->pos004;
    $address = $address1.$address2.$orderData->odm017;

    //統一發票
    $photo = Receipt::find_by_rec002($orderData->odm001) ?: new Receipt;
    // $imageSrc = System::get('url') . "/photo/receipt/";
    // if($photo->rec003!=''){
    //     $photoSrc = explode(".", $photo->rec003);
    //     $imageSrc = "/photo/receipt/".$photoSrc[0].".min.".$photoSrc[1];
    // }else{
    //     $imageSrc = "";
    // }

    foreach ($list as $k) {
        //產品編號
        $data[] = $k->pid;
    }

    $options = array(
        'conditions' => array(
            'pdm001 in (?)',
            $data
        ),
    );
    $result = Product::find('all', $options);
    // echo "<pre>result"; print_r($result); echo "</pre>";

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
    // echo "<pre>"; print_r($rows); echo "</pre>";

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

    //取貨序號
    $getNo = $orderData->odm011 ?: Null;
    // $delivery = $orderData->odm007->format("Y-m-d");
    // $signoff = $orderData->odm008->format("Y-m-d");
    // strtotime(Input::post('delivery')) ?: Null;
    $d1 = $orderData->odm007 ? $orderData->odm007->format("Y-m-d") : Null;
    $s1 = $orderData->odm005 ? $orderData->odm005->format("Y-m-d") : Null;
    $r1 = $orderData->odm008 ? $orderData->odm008->format("Y-m-d") : Null;

    $signoff = $s1 ?: NULL;
    $delivery = $d1 ?: NULL;
    $receivable = $r1 ?: NULL;

    if($orderData->odm010=="csv"){
        $getMethods = "到店取貨";
        $get_No = "取貨序號";
        $get_Date = "取貨日期";
    }elseif($orderData->odm010=="house"){
        $getMethods = "宅配";
        $get_No = "出貨序號";
        $get_Date = "出貨日期";
    }

    $tpl->assign('get_No',$get_No);
    $tpl->assign('get_Date',$get_Date);
    $tpl->assign('photo',$photo);
    $tpl->assign('orderData',$orderData);
    $tpl->assign('memberData',$memberData);
    $tpl->assign('list',$list);
    $tpl->assign('product',$rows);
    $tpl->assign('sum',$sum);
    $tpl->assign('correct_sum',$correct_sum);
    $tpl->assign('shoppinggold',$shoppinggold);
    $tpl->assign('getNo',$getNo);
    $tpl->assign('delivery',$delivery);
    $tpl->assign('signoff',$signoff);
    $tpl->assign('receivable',$receivable);
    $tpl->assign('getMethods',$getMethods);
    $tpl->assign('address',$address);
    $tpl->display('page12_order_modify.tpl');



?>