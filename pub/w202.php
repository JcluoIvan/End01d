<?php
// 取得某會員詳細資料

use model\Member;

// echo "<pre>";
// var_dump($_POST);

// 判斷
// 有無此mid

// 修改
// 回傳訊息

class w202 {

    public function run()
    {
        $mid = Input::post('mid') ?: 0;

        // $cols = array(
        //     'id', 'no', 'account', 'name', 'born', 'bank_account', 'city',
        //     'address', 'bank', 'phone', 'email', 'qrcode', 'qrcodeId',
        // );

        // $result = Member::getInfoByMid($mid);

        // $rows = array();

        // foreach ($result as $row) {
        //     $rows[] = $row->attributes($cols);
        // }

        $data = User::data()->loginMemberData();

        return array(
            'status' => $rows ? true : false,
            'message' => 'true',
            'member' => $data
        );
    }
}