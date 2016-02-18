<?php
use model\Agent;
use model\Swap;
use model\SwapDetail;
use model\Product;
use model\ProductInventory;
use model\Member;
use model\Order;
use model\OrderDetail;

class c1204 {

    public function run() {
        $lv2 = Input::post('lv2');
        $id = Input::post('oid');
        $mid = Input::post('mid');
        
        $agent = Agent::find_by_age001($lv2);
        $lv2City = $agent->age009;
        $lv2Address = $agent->age010;
        $Address = $lv2City.$lv2Address;

        $swap = new Swap;
        
        // 產品資料
        $pid = Input::post('pid');
        $pData = Product::find_by_pdm001($pid) ?: 0;
        $tmpPdata = $pData->attributes(true);
        $pmoney = $tmpPdata['member_price'] ?: 0;

        $keyman1 = User::get('account');
        
        $swap->ods002 = Input::post('oid') ?: 0;            //訂單編號
        $swap->ods003 = Input::post('sNO') ?: 0;            //換貨編號
        $swap->ods004 = Input::post('mid') ?: 0;            //會員編號
        $swap->ods005 = Input::post('lv2') ?: 0;            //雷達站編號
        $swap->ods006 = Input::post('pid') ?: 0;            //產品編號
        $swap->ods007 = $pmoney ?: 0;                       //產品金額
        $swap->ods008 = Input::post('amount') ?: 0;         //換貨數量
        $swap->ods009 = Input::post('reason') ?: null;      //換貨原因
        $swap->ods010 = $Address;                           //換貨地址
        $swap->ods011 = $keyman1;                         //最後修改人員
        $swap->ods012 = date("Y-m-d H:i:s");              //日期記錄
        $swap->ods013 = Input::post('status') ?: 1;       //目前狀態

        // $pid_array = Input::post('pid');
        // $oid = Input::post('oid') ?: 0;                 //訂單編號
        // $pname_array = Input::post('pname') ?: 0;       //產品名稱
        // $pmoney_array = Input::post('pmoney') ?: 0;     //產品單價金額
        // $amount_array = Input::post('amount') ?: 0;     //換貨數量

        // foreach ($pid_array as $i => $pid) {
        //     $detail = new SwapDetail;
        //     $detail->osd002 = $oid;
        //     $detail->osd003 = $pid;
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

}