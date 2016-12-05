<?php
use model\Order;
use model\OrderDetail;
use model\RadarStatement;
use model\Swap;

class c326 extends pub\GatewayApi{

    public function run() {
        $checkData = Input::post('checkData');
        $date1 = Input::post('date1');
        $date2 = Input::post('date2');
        $id = User::get('id');
        $name = User::get('name');
        $account = User::get('account');

        if (count($checkData) == 0) return ;
        $options = array(
            'conditions' => array(
                'odm001 IN (?) AND odm005 BETWEEN ? AND ?',
                $checkData,
                $date1,
                $date2
            ),
        );

        // for ($i=0; $i < count($checkData); $i++) {
            $order = Order::find('all', $options);
            $count = intval(Order::count($options));

            if($count > 0){
                $rows = array();
                foreach ($order as $row) {
                    $tmp = $row->attributes(true);
                    $rows[] = $tmp;

                    $openaccount = 0;
                    $saveOrder = Order::find('first', array('conditions' => array( 'odm001 = ?', $tmp['sn']))) ?: new Order;
                    $saveOrder->odm035 = $openaccount;
                    $saveOrder->save();

                    $RadarStatement = RadarStatement::find('first', array('conditions' => array( 'rat006 = ?', $saveOrder->odm001))) ?: new RadarStatement;
                    $result = $RadarStatement->delete();

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