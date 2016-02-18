<?php
use model\Swap;
use model\SwapDetail;
use model\Product;
use model\ProductPhoto;
use model\ProductInventory;
use model\Member;
use model\Order;
use model\OrderDetail;

class c306 {

    public function run() {
        $status = Input::post('status');
        $id = Input::post('oid');
        $sNO = Input::post('sNO');
        $mid = Input::post('mid');
        $pid = Input::post('pid');
        $pmoney = Input::post('money');
        $amount = Input::post('amount');
        $swapdate = Input::post('swapdate');
        $order = Order::find_by_odm001($id);
        $odata = $order->attributes(true);
        $address = $odata['city'].$odata['address'];
        $orderDetail = OrderDetail::find('first', array('conditions' => array( 'odd002 = ? AND odd003 = ?', $id, $pid)));
        $odl = $orderDetail->attributes(true);
        
        //換貨數量 > 購買數量
        // if($amount > $odl['count']){ return; }

        $swap = Swap::find('first', array('conditions' => array( 'ods002 = ? AND ods003 = ?', $id, $sNO))) ?: new Swap;
        $keyman1 = User::get('account');
        
        $no = $swap->ods003 ?: $this->crateNo(
                $order->odm001,
                $order->odm002,
                $swap->ods001
            );
        $swap->ods002 = Input::post('oid') ?: 0;              //訂單編號
        $swap->ods003 = $no;                                  //退貨編號
        $swap->ods004 = Input::post('mid') ?: 0;              //會員編號
        $swap->ods005 = Input::post('lv2') ?: 0;              //雷達站編號
        $swap->ods006 = Input::post('pid') ?: 0;              //產品編號
        $swap->ods007 = $pmoney ?: 0;                         //產品金額
        $swap->ods008 = Input::post('amount') ?: 0;           //換貨數量
        $swap->ods009 = Input::post('reason') ?: null;        //換貨原因
        $swap->ods010 = $address;                             //換貨地址
        $swap->ods011 = $keyman1 ?: null;                     //最後修改人員
        $swap->ods012 = Input::post('signoff') ?: date("Y-m-d");       //日期記錄
        // $swap->ods013 = $status;                               //目前狀態
        // $reject->ods014 = $reject->ods014 ? $reject->ods014: null; //核帳日期
        $swap->ods015 = $swapdate ?: null; //換貨日期

        // $pid_array = Input::post('pid');
        // $oid = Input::post('oid') ?: 0;                 //訂單編號
        // $pname_array = Input::post('productname') ?: 0;       //產品名稱
        // $pmoney_array = Input::post('pmoney') ?: 0;     //產品單價金額
        // $amount_array = Input::post('amount') ?: 0;     //換貨數量

        // foreach ($pid_array as $i => $pid) {
        //     //符合訂單編號與產品編號的條件
        //     $options = array(
        //         'conditions' => array(
        //             'osd002 = ? AND osd003 = ?', 
        //             $oid, 
        //             $pid_array[$i]
        //         ),
        //     );

        //     $detail = swapDetail::first($options) ?: new swapDetail;
        //     $detail->osd002 = $oid;
        //     $detail->osd003 = $pid_array[$i];
        //     $detail->osd004 = $pname_array[$i];
        //     $detail->osd005 = $pmoney_array[$i];
        //     $detail->osd006 = $amount_array[$i];
        //     if ($amount_array[$i] <= 0) continue;
        //     $detail->save();
        // }

        $result = $swap->save();

        return array(
            'err' => ($result ? 0 : 1),
            'msg' => ($result ? Lang::get('save.success') : Lang::get('save.fail')),
        );
        
    }
    public function crateNo($oid, $ono, $rid) {

        $row = Swap::first(array(
            'select' => 'MAX(ods003) AS no',
            'conditions' => array('ods002 = ?', $oid)
        ));
        $no = '01';
        if (! empty($row)) {
            $no = intval(substr($row->no, -2)) + 1;
            $no = substr("0{$no}", -2);
        }
        return "{$ono}B{$no}";
    }


}