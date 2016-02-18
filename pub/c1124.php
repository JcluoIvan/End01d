<?php
// 會員加人黑名單

use model\Member;

// var_dump($_POST);

// exit;

class c1124 {

    public function run() {

        $mid = Input::post('mid');

        $member = Member::find_by_mem001($mid) ?: new Member;
        
        /* 是否黑名單 */
        $member->mem023 = 1;
        /* 加入黑單日期 */
        $member->mem024 =  DATE('Y/m/d');
        /* 加入黑單原因 */
        $member->mem025 = Input::post('blacklistReason') ?: null;
        /* 加入黑單操作人員ID */
        $member->mem026 = User::get('id') ?: 0;

        $result = $member->save();

        return array(
            'status' => $result ? true : false,
            'message' => $member->getError() 
                ?: ($result 
                    ? Lang::get('save.success')
                    : Lang::get('save.fail')
                ),
        );
        
    }

}