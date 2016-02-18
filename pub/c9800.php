<?php
/* 個人資料修改 */
use model\Agent;
use model\Member;
use model\LogAgent;
class c9800 extends pub\GatewayApi{

    public function run() 
    {
    
        $id = User::get('id');
        $row = Agent::find_by_age001($id);
        if (empty($row)) return $this->fail('資料不正確');

        if (trim(Input::post('new_password'))) {
            $row->age005 = trim(Input::post('new_password'));
        }
        $row->age009 = Input::post('city');
        $row->age010 = Input::post('address');
        $row->age011 = Input::post('bank_account');
        // $row->age012 = Input::post('phone');
        $row->age013 = Input::post('email');
        $row->age021 = Input::post('bank_code');
        $row->addValidate('[name=source_password]', 'age005', function() use ($row) {
            $data = $row->getUpdateAttribute();
            return (isset($data['age005']) && ($data['age005'] != Input::post('source_password')))
                ? '原密碼不正確' : true;
        });
        $row->addValidate('[name=confirm_password]', 'age005', function($value) use($row) {
            return (Input::post('new_password') !== Input::post('confirm_password'))
                ? '兩次輸入的密碼不相同' : true;
        });
        return $row->save()
            ? $this->success('資料修改完成')
            : $this->fail('資料修改失敗');

    }

   
}