<?php
use model\Setting;
class c9992 extends \pub\GatewayApi{

    public function run() 
    {
        
        $id = Input::post('id');

        $row = Setting::find_by_set001($id) ?: null;

        if (empty($row)) return $this->fail('查無此資料！');

        $method = "update{$row->set002}";

        return call_user_func_array(array($this, $method), array($row));

    }


    public function updateBankAccount($row) 
    {
        $code = Input::post('bank_code');
        $account = Input::post('bank_account');

        $row->set004 = "{$code}*{$account}";
        return $row->save()
            ? $this->success()
            : $this->fail('儲存失敗');
    }

    public function updateEmailNotice($row) 
    {
        $result = true;
        $emails = Input::post('emails');
        $disabled = Input::post('disabled') ? 1 : 0;

        $row->set004 = json_encode(array(
            'emails' => $emails,
            'disabled' => $disabled,
        ));
        return $result && $row->save()
            ? $this->success()
            : $this->fail();

    }

}