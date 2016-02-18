<?php
// 會員停用

use model\Member;

class c1123 {

    public function run()
    {
        $id = Input::post('id');

        $member = Member::find_by_mem001($id) ?: array();

        $member->mem003 = "#{$member->mem003}";
        $member->mem011 = "#{$member->mem011}";
        $member->mem014 = 1;
        /* 除會不檢查 save(false) */
        $result = $member->save(false);

        $this->modifyRelatedMember($id);

        return array(
            'status' => true,
            'message' => ''
        );


    }

    public function modifyRelatedMember($parentMid)
    {
        $values = array($parentMid);

        $sql = 'UPDATE member SET
                mem018 = 0, mem019 = 0, mem020 =0
                WHERE mem020 = ?';

        Member::connection()->query($sql, $values);

        $sql = 'UPDATE member SET
                mem018 = 0, mem019 = 0
                WHERE mem019 = ?';

        Member::connection()->query($sql, $values);

        $sql = 'UPDATE member SET
                mem018 = 0
                WHERE mem018 = ?';

        Member::connection()->query($sql, $values);
    }

}