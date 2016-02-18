<?php
use model\Setting;
class c9991 extends \pub\GatewayApi{

    public function run() 
    {
        
        $id = Input::post('id');
        $value = Input::post('value');

        $row = Setting::find_by_set001($id) ?: null;

        $result = false;

        if ($row) {

            $row->set004 = $value;
            return $row->save()
                ? $this->success()
                : $this->fail('修改失敗');
        }
        return $this->fail('查無此資料');


        

    }

}