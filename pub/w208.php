<?php
use model\Member;

/**
 * 更新會員購物金
 */

class w208 {

    public function run()
    {

        return array(
            'status' => true,
            'point' => User::get('point') ?: 0,
        );

        
    }
}