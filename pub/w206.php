<?php
use model\Member;

/**
 * 會員個資修改
 */

class w206 extends pub\GatewayApi {

    public function run()
    {
        $source_password = Input::post('source_password') ?: null;
        $new_password = Input::post('new_password');
        $member = Member::find_by_mem001(User::get('id'));
        if (empty($member)) return $this->fail('資料不正確');


        $member->mem004 = Input::post('password');
        $member->addValidate('[name=source_password]', 'mem004', function() use ($member) {
            $data = $member->getUpdateAttribute();
            return (isset($data['mem004'])) && $data['mem004'] !== Input::post('source_password')
                ? '原密碼不正確'
                : true;
        });

        $member->addValidate('[name=confirm_password]', 'mem004', function($value) use ($member) {
            return Input::post('confirm_password') !== $value
                ? '兩次輸入的密碼不相同'
                : true;
        });
        return $member->save()
            ? $this->success('修改成功')
            : $this->fail('修改失敗');
    }
}