<?php
use model\Reject;
use model\Product;
use model\ProductPhoto;
use model\ProductInventory;
use model\Member;
use model\Order;
use model\OrderDetail;

class c305 extends pub\GatewayApi{

    public function run() {
        $sn = Input::post('sn') ?: null;
        $status = Input::post('status');
        $id = Input::post('oid');
        $rNO = Input::post('rNO') ?: 0;
        $mid = Input::post('mid');
        $pid = Input::post('pid');
        $amount = Input::post('amount');
        $rejectdate = Input::post('rejectdate');
        // $address = Input::post('address');
        $order = Order::find_by_odm001($id);
        $odata = $order->attributes(true);
        $address = $odata['city'].$odata['address'];
        $orderDetail = OrderDetail::find('first', array('conditions' => array( 'odd002 = ? AND odd003 = ?', $id, $pid)));
        $odl = $orderDetail->attributes(true);
        $pmoney = $odl['money'];
        

        $options = array(
                // 'select' => '*, SUM(odr008) AS rejectAmount',
                'conditions' => array(
                    'odr001 = ? AND odr002 =?',
                    //'odr002 = ? AND odr003 = ?',
                    $sn,
                    $id,
                    // $rNO,
                )
            );

        $reject = Reject::find('first', $options) ?: new Reject;
        // $reject = Reject::find('first', array('conditions' => array( 'odr002 = ? AND odr003 = ?', $id, $rNO))) ?: new Reject;
        $keyman1 = User::get('account');
        // $pid = Input::post('pid');
        $rTmoney = Input::post('rTmoney') ?: 0;
        $rTpoint = Input::post('rTpoint') ?: 0;
        
        // if(!$odata['check_date']){
        //     return array(
        //         'err' => 1,
        //         'msg' => Lang::get('save.fail'),
        //     );
        // }
        
        $no = $reject->odr003 ?: $this->crateNo(
                $order->odm001,
                $order->odm002,
                $reject->odr001
            );
        $reject->odr002 = Input::post('oid') ?: 0;              //訂單編號
        $reject->odr003 = $no;                                  //退貨編號
        $reject->odr004 = Input::post('mid') ?: 0;              //會員編號
        $reject->odr005 = Input::post('lv2') ?: 0;              //雷達站編號
        $reject->odr006 = Input::post('pid') ?: 0;              //產品編號
        $reject->odr007 = $pmoney ?: 0;                         //產品金額
        $reject->odr008 = Input::post('amount') ?: 0;           //退貨數量
        $reject->odr009 = Input::post('reason') ?: null;        //退貨原因
        $reject->odr010 = $address;                             //退貨地址
        $reject->odr011 = $keyman1;                             //最後修改人員
        $reject->odr012 = Input::post('signoff') ?: date("Y-m-d");       //日期記錄
        // $reject->odr013 = $reject->odr013 ? $reject->odr013: 0; //目前狀態
        $reject->odr014 = $rTmoney ?: 0;                        //退貨總金額
        $reject->odr015 = $rTpoint ?: 0;                        //退貨總點數
        // $reject->odr016 = $reject->odr016 ? $reject->odr016: null; //核帳日期
        $reject->odr017 = $rejectdate ?: null; //退貨日期

        // $order->odm032 = $rTTmoney+$rTmoney ?: 0;
        // $order->odm033 = $rTTPoint+$rTpoint ?: 0;
        // $order->save();

        $result = $reject->save();

        $status = Input::post('status');
        if($status == 1){
            /* 更新相關會員的 point */
            $order = Order::find_by_odm001($id);
            $tmporder = $order->attributes(true);
            $mid = $tmporder['mid'];
            // $member = Member::find_by_mem001($mid);
            // $order->recalculateMemberPoint();
            // $member->recalculatePoint();

        }
        /* 更新相關雷達站的庫存 */
        // $reject->recalculateProductInventoryDetail();

        /* 更新庫存剩餘數量 */
        // ProductInventory::countProduct($pid, Input::post('lv2'));    

        return array(
            'err' => ($result ? 0 : 1),
            'msg' => ($result ? Lang::get('save.success') : Lang::get('save.fail')),
        );
        
    }
    public function crateNo($oid, $ono, $rid) {

        $row = Reject::first(array(
            'select' => 'MAX(odr003) AS no',
            'conditions' => array('odr002 = ?', $oid)
        ));
        $no = '01';
        if (! empty($row)) {
            $no = intval(substr($row->no, -2)) + 1;
            $no = substr("0{$no}", -2);
        }
        return "{$ono}A{$no}";
    }

}