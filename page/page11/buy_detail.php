<?php
    /* 購買明細  報表用 */

    include '../../conf/config.php';
    
    use model\Order;
    use model\OrderDetail;
    use model\Reject;
    use model\Swap;

    // 修改
    //核帳日期

    $oid = intval(Input::get('oid'));

    $options = array(
        'conditions' => array(
            'odm001 = ?', $oid,
        ),
    );

    $order = Order::find('first', $options) ?: new Order;

    $date = $order->odm006 
        ? $order->odm006->format('Y-m-d') ?: ''
        : '';

    /* 運費 */
    $oder_fare = $order->odm029 ?: 0;
    /* 商品金額(已扣除使用購物金) */
    $product_amount = $order->odm030 ?: 0;
    /* 退貨金額 */
    $reject_amount = $order->odm032 ?: 0;
    /* 退貨購物金 */
    $reject_point = $order->odm033 ?: 0;

    /* 使用購物金 */
    $oder_point = $order->odm004 ?: 0;

    /* 現金 = 商品金額 + 運費 - 退貨金額  ($reject_point退貨購物金不加,加再實際購物金) */
    $cash = $product_amount + $oder_fare - $reject_amount;

    /* 總金額 = 現金 + 使用購物金 */
    $total = $cash + $oder_point;

    $pay = array(
        'cash' => 0, 'card' => 0, 'atm' => 0,
    );

    $pay[$order->odm009] = $cash;

    $options = array(
        'select' => 
            'odd002, odd003, SUM(odd006) AS total',

        'conditions' => array(
            'odd002 = ?', $oid,
        ),
        'group' => 'odd003',
    );

    $result = OrderDetail::with(
        OrderDetail::find('all', $options),
        array('product')
    ) ?: new OrderDetail;

    $buyDetail = array();

    foreach ($result as $key => $row) {
        if (!$row)
            continue;
        $buyDetail[$key]['no'] = is_object($row->product) ? $row->product->pdm002 : null;
        $buyDetail[$key]['name'] = is_object($row->product) ? $row->product->pdm004 : null;
        $buyDetail[$key]['total'] = $row->total;
    }

    $options = array(
        'select' => 
            'odr002, odr006, odr007, SUM(odr008) AS total',

        'conditions' => array(
            'odr002 = ? AND odr016 NOT IN ("null", "0000-00-00", "")', $oid
        ),
        'group' => 'odr006',
    );

    $result = Reject::with(
        Reject::find('all', $options),
        array('product')
    ) ?: new Reject;

    $reject = array();

    foreach ($result as $key => $row) {
        if (!$row)
            continue;
        $reject[$key]['no'] = $row->product->pdm002;
        $reject[$key]['name'] = $row->product->pdm004;
        $reject[$key]['total'] = $row->total;
    }

    $options = array(
        'select' => 
            'ods002, ods006, SUM(ods008) AS total',

        'conditions' => array(
            'ods002 = ? AND ods014 NOT IN ("null", "0000-00-00", "")', $oid
        ),
        'group' => 'ods006',
    );

    $result = Swap::with(
        Swap::find('all', $options),
        array('product')
    ) ?: new Swap;

    $swap = array();

    foreach ($result as $key => $row) {
        if (!$row)
            continue;
        $swap[$key]['no'] = $row->product->pdm002;
        $swap[$key]['name'] = $row->product->pdm004;
        $swap[$key]['total'] = $row->total;
    }

    $tpl->assign('reject_amount', $reject_amount);
    $tpl->assign('reject_point', $reject_point);
    $tpl->assign('oder_point', $oder_point);
    $tpl->assign('oder_fare', $oder_fare);
    $tpl->assign('pay', $pay);
    $tpl->assign('total', $total);
    $tpl->assign('date', $date);
    $tpl->assign('buyDetail', $buyDetail);
    $tpl->assign('reject', $reject);
    $tpl->assign('swap', $swap);
    $tpl->display('page11_buy_detail.tpl');

