<?php
use model\Order;
use model\OrderDetail;
use model\RadarStatement;

class c316 extends pub\GatewayApi{

    public function run() {
        $checkData = Input::post('checkData');
        $money = Input::post('money');
        $date1 = Input::post('date1');
        $date2 = Input::post('date2');
        $id = User::get('id');
        $name = User::get('name');
        $account = User::get('account');

        // $saveData = array();
        // for($i=0;$i<count($checkData);$i++){
        //     $saveData[] = array($checkData[$i]);
        // }

        if (count($checkData) == 0) return ;
        // $checkDate = '0000-00-00';
        $options = array(
            'select' => 'odm001 as id, odm022, odm029 AS fare, odm030 AS total',
            'conditions' => array(
                'odm005 IS NOT NULL AND odm001 IN (?) AND odm005 BETWEEN ? AND ?',
                // $checkDate,
                $checkData,
                $date1,
                $date2
            ),
            // 'group' => 'odm022'
        );

        $order = Order::find('all', $options);
        // $sql = Order::connection()->last_query;
        // print_r($sql);
        
        $count = count($order);
        if ($count == 0) return $this->fail('訂貨單目前尚無已核帳資料。');
        if($count > 0){
            $rows = array();
            foreach ($order as $row) {
                $tmp = $row->attributes(true);
                // foreach ($saveData as $k) {
                //     if($tmp['lv2id']==$k[0]){
                //         $tmp['savemoney'] = $k[1];
                //     }
                // }
                // if($tmp['total']!=$tmp['savemoney']){
                //     return $this->fail('資料不正確，請重新整理。');
                // }
                    
            $optionsSave = array(
                // 'select' => 'odm022, odm029 AS fare, odm030 AS total',
                'conditions' => array(
                    'odm001 IN (?) ',
                    $tmp['id'],
                )
            );
            $openaccount = 1;
            $saveOrder = Order::find('first', array('conditions' => array( 'odm001 = ?', $tmp['id']))) ?: new Order;
            $saveOrder->odm035 = $openaccount;
            $saveOrder->save();

            $RadarStatement = RadarStatement::find('first', array('conditions' => array( 'rat002 = ? and rat003 = ?', $tmp['lv2id'], $tmp['total']))) ?: new RadarStatement;
            // $RadarStatement = new RadarStatement;
            $RadarStatement->rat002 = $tmp['lv2id'] ?: 0;                   //雷達站編號
            $RadarStatement->rat003 = $tmp['total'] ?: 0;                   //實收金額
            $RadarStatement->rat004 = date("Y-m-d H:i:s") ?: null;          //核帳日期
            $RadarStatement->rat005 = $account ?: null;                     //操作人員
                
            $result = $RadarStatement->save();
            }    
        }else{
            return $this->fail('無此資料。');
            // return array(
            //         'err' => 1,
            //         'msg' => "無此資料",
            //     );    
        }
        return $this->success();
        // return array(
        //         'err' => ($result ? 0 : 1),
        //         'msg' => ($result ? Lang::get('save.success') : Lang::get('save.fail')),
        //     );
        
    }

}