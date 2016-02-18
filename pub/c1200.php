<?php
use model\Agent;
use model\Reject;
use model\RejectDetail;
use model\Product;
use model\ProductInventory;
use model\Member;
use model\Order;
use model\OrderDetail;

class c1200 {

    public function run() {
        $lv2 = Input::post('lv2');
        $id = Input::post('oid');
        $mid = Input::post('mid');

        $agent = Agent::find_by_age001($lv2);
        $lv2City = $agent->age009;
        $lv2Address = $agent->age010;
        $Address = $lv2City.$lv2Address;
        $reject = new Reject;
        // $reject = Reject::find_by_odr002($id) ?: new Reject;
        // var_dump(user::data('account'));

        // 產品資料
        $pid = Input::post('pid');
        $pData = Product::find_by_pdm001($pid) ?: 0;
        $tmpPdata = $pData->attributes(true);
        $pmoney = $tmpPdata['member_price'] ?: 0;
        
        $keyman1 = User::get('account');
        
        $reject->odr002 = Input::post('oid') ?: 0;              //訂單編號
        $reject->odr003 = Input::post('rNO') ?: 0;              //退貨編號
        $reject->odr004 = Input::post('mid') ?: 0;              //會員編號
        $reject->odr005 = Input::post('lv2') ?: 0;              //雷達站編號
        $reject->odr006 = Input::post('pid') ?: 0;              //產品編號
        $reject->odr007 = $pmoney ?: 0;                         //產品金額
        $reject->odr008 = Input::post('amount') ?: 0;           //退貨數量
        $reject->odr009 = Input::post('reason') ?: null;        //退貨原因
        $reject->odr010 = $Address;                             //退貨地址
        $reject->odr011 = $keyman1;                             //最後修改人員
        $reject->odr012 = date("Y-m-d H:i:s");                  //日期記錄
        $reject->odr013 = Input::post('status') ?: 1;           //目前狀態
        
        $oid = Input::post('oid') ?: 0;                 //訂單編號
        // $pname_array = pname ?: 0;                       //產品名稱
        // $pmoney_array = Input::post('pmoney') ?: 0;     //產品單價金額
        // $amount_array = Input::post('amount') ?: 0;     //退貨數量
        // foreach ($pid_array as $i => $pid) {
        // $detail = new RejectDetail;
        // $detail->ord002 = $oid;
        // $detail->ord003 = $pid;
        // $detail->ord004 = $pname;
        // $detail->ord005 = $pmoney;
        // $detail->ord006 = $amount;
        
        // //$detail->ord004 = $pname_array[$i];
        // $detail->ord005 = $pmoney_array[$i];
        // $detail->ord006 = $amount_array[$i];
        
        // $reject->ord007 = $keyman1;                             //key單人員
        // $reject->ord008 = Input::post('keyman2') ?: $keyman2;    //修改人員
        // $reject->ord009 = Input::post('status') ?: 1;           //目前狀態
        // $reject->ord010 = date("Y-m-d H:i:s");                  //日期記錄
        // if ($amount_array[$i] <= 0) continue;
        // $detail->save();
        
        // }
        /* 更新相關會員的 point */
        $order = Order::find_by_odm001($oid);
        $tmporder = $order->attributes(true);
        // $member = Member::find_by_mem001($mid);
        // $order->recalculateMemberPoint();
        // $member->recalculatePoint();

        /* 更新相關雷達站的庫存 */
        // $order->recalculateProductInventoryDetail();
        /* 更新庫存剩餘數量 */
        // ProductInventory::countProduct($pid, Input::post('lv2'));

        // if (Reject::getTypes($reject->odr002) === null) {
        //     return array(
        //         'err' => 1,
        //         'msg' => Lang::get('page03.validator.odr002'),
        //     );
        // }

        $result = $reject->save();

        /* 更新相關雷達站的庫存 */
        // $reject->recalculateProductInventoryDetail();

        /* 更新庫存剩餘數量 */
        ProductInventory::countProduct($pid, Input::post('lv2'));

        return array(
            'err' => ($result ? 0 : 1),
            'msg' => ($result ? Lang::get('save.success') : Lang::get('save.fail')),
        );
        
    }

}