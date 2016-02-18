<?php
use model\Order;
use model\OrderDetail;
use model\RadarStatement;
use model\Reject;

class c318 extends pub\GatewayApi{

    public function run() {
        $checkData = Input::post('checkData');  // 退貨單流水號
        $date1 = Input::post('date1');
        $date2 = Input::post('date2');
        $id = User::get('id');
        $name = User::get('name');
        $account = User::get('account');

        $saveData = array();
        for($i=0;$i<count($checkData);$i++){
            $saveData[] = array($checkData[$i]);
        }

        if (count($checkData) == 0) return ;
        $options = array(
            'select' => 'odr001, odr002, odr011 as keyman, odr012, odr013, odr014, odr015, odr016, odr017',
            'conditions' => array(
                'odr001 IN (?) AND odr012 BETWEEN ? AND ?',
                $checkData,
                $date1,
                $date2
            ),
            // 'group' => 'odr002'
        );

        $checkDataCount = count($checkData);

        $reject = Reject::find('all', $options);
        $count = count($reject);

        if($count > 0){
            $rows = array();
            $orderID = array();
            foreach ($reject as $row) {
                $tmp = $row->attributes(true);
                $rows[] = $tmp;
                $orderID[] = $tmp['oid'];
                
                if(empty($tmp['rejectdate'])){
                    return $this->fail('退貨程序尚未完成！');
                }

                $RejectData = Reject::find('first', array('conditions' => array( 'odr001 = ?', $tmp['sn']))) ?: new Reject;
                $RejectData->odr011 = $account ?: null;                     //操作人員
                $RejectData->odr013 = 1 ?: 0;                               //核帳狀態
                $RejectData->odr016 = date("Y-m-d") ?: null;                //核帳日期
                $RejectData->save();

                // $order = Order::find_by_odm001($tmp['oid']);
                // $tmpForOrder = $order->attributes(true);
                // $rTTmoney = $tmpForOrder['reject_shopgold'] + $tmp['rTmoney'];
                // $rTTpoint = $tmpForOrder['reject_point'] + $tmp['rTpoint']; 
                // $order->odm032 = $rTTmoney ?: 0;
                // $order->odm033 = $rTTpoint ?: 0;
                // $result = $order->save();
            }
            
            $rejectStatus = 1;
            $orderID2 = array_unique($orderID);
            $j = 0;
            foreach ($orderID2 as $k => $v) {
                $orderID3[$j] = $v;
                $j++;
            }
            for($i=0; $i<count($orderID3); $i++){
                $options2 = array(
                    'select' => 'odr002 AS oid, SUM(odr014) AS rMoney, SUM(odr015) AS rPoint',
                    'conditions' => array(
                        'odr002 = ? AND odr013 = ?',
                        $orderID3[$i],
                        $rejectStatus,
                    ),
                    'group' => 'odr002'
                );
                $RejectData2 = Reject::find('first', $options2) ?: new Reject;
                $ddata = $RejectData2->attributes(true);
                $InsData[] = $ddata;

                $order = Order::find_by_odm001($InsData[$i]['oid']);
                $order->odm032 = $InsData[$i]['rmoney'] ?: 0;
                $order->odm033 = $InsData[$i]['rpoint'] ?: 0;
                $order->save();
            }
            return $this->success(); 
        }else{
            return $this->fail(Lang::get('save.fail'));
        }

        // return array(
        //         'err' => ($result ? 0 : 1),
        //         'msg' => ($result ? Lang::get('save.success') : Lang::get('save.fail')),
        //     );
        
    }

}