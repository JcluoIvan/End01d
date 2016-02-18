<?php
// 客服記錄 新增 修改

use model\Dialogue;

class c123 {

    public function run() {

        $id = Input::post('id');
        $mid = Input::post('mid');

        $dialogue = $id ? Dialogue::find_by_dia001($id) : new Dialogue;

        $dialogue->dia002 = $dialogue->dia002 ?: $mid;
        $dialogue->dia003 = User::get('id') ?: 0;
        $dialogue->dia004 = Input::post('content');
        $dialogue->dia005 = date('Y/m/d H:i:s');

        $result = $dialogue->save();

        return array(
            'status' => $result ? true : false,
            'message' => $dialogue->getError() 
                ?: ($result 
                    ? Lang::get('save.success')
                    : Lang::get('save.fail')
                ),
        );
        
    }

}