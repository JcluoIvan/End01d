<?php
use model\Order;
use model\OrderDetail;
use model\RadarStatement;
use model\Swap;

class c1219 extends pub\GatewayApi{

    public function run() {
        $checkData = Input::post('checkData');
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
            'select' => 'ods001, ods011 as keyman, ods012, ods013, ods014, ods015',
            'conditions' => array(
                'ods001 IN (?) AND ods012 BETWEEN ? AND ?',
                $checkData,
                $date1,
                $date2
            ),
            // 'group' => 'ods002'
        );
        
        // for ($i=0; $i < count($checkData); $i++) { 
            $swap = Swap::find('all', $options);
            $count = count($swap);

            if($count > 0){
                $rows = array();
                foreach ($swap as $row) {
                    $tmp = $row->attributes(true);
                    $rows[] = $tmp;

                    if(empty($tmp['swapdate'])){
                        return $this->fail('換貨程序尚未完成！');
                    }

                    $SwapData = Swap::find('first', array('conditions' => array( 'ods001 = ?', $tmp['sn']))) ?: new Swap;
                    $SwapData->ods011 = $account ?: null;                     //操作人員
                    $SwapData->ods013 = 1 ?: 0;                               //核帳狀態
                    $SwapData->ods014 = date("Y-m-d") ?: null;                //核帳日期
                    
                    $result = $SwapData->save();
                }
                return $this->success();   
            }else{
                return $this->fail(Lang::get('save.fail'));
            }
        // }

        // return array(
        //         'err' => ($result ? 0 : 1),
        //         'msg' => ($result ? Lang::get('save.success') : Lang::get('save.fail')),
        //     );
        
    }

}