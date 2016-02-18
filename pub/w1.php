<?php
use model\AppRegister;
/* 儲存 app register id */
class w1 extends pub\GatewayApi{

    public function run() 
    {

        $app = new AppRegister;

        /* member id */
        $app->ari001 = Input::post('mid');

        /* device type : android or ios .... */
        $app->ari002 = Input::post('type');

        /* device uuid */
        $app->ari003 = Input::post('uuid');
        
        /* register id */
        $app->ari004 = Input::post('rid');

        if (Input::post('unregister')) {
            $sql = "DELETE FROM `app_register_id` WHERE ari001 = ? AND ari003 = ?";
            $values = array(Input::post('mid'), Input::post('uuid'));
            AppRegister::connection()->query($sql, $values);
            return $this->success();
        }        

        $result = $remove ? $app->unregisterDevice() : $app->registerDevice();
        if ($app->registerDevice()) {
            return array(
                'status' => true,
            );
        } else {
            // 錯誤要另外記在 errlog
            return array(
                'status' => false,
                'message' => '建立失敗'
            );
        }

    }

}