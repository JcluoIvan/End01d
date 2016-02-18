<?php
use model\Order;
use model\OrderDetail;
use model\RadarStatement;
use model\Reject;

class c1221 extends pub\GatewayApi{

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
            'select' => 'odr001, odr002, odr011 as keyman, odr012, odr013, odr014, odr015',
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
                    
                $RejectData = Reject::find('first', array('conditions' => array( 'odr001 = ?', $tmp['sn']))) ?: new Reject;
                $RejectData->odr011 = $account ?: null;                     //操作人員
                $RejectData->odr013 = 2 ?: 0;                               //核帳狀態
                $RejectData->odr016 = date("Y-m-d") ?: null;                //核帳日期
                // $RejectData->odr017 = date("Y-m-d H:i:s");                  //顧客退貨領取日期
                $RejectData->save();
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