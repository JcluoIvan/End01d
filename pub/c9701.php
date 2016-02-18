<?php
use model\MobileTitle;
# mobile title image save
class c9701 extends \pub\GatewayApi {

    public function run() 
    {
        $ids = Input::post('ids') ?: array();

        $sql = 'UPDATE `mobile_title` SET mbt003 = 0';
        MobileTitle::connection()->query($sql);

        if (empty ($ids)) return $this->success('更新成功');

        $ids = implode(',', array_map('intval', $ids));
        $sql = "UPDATE `mobile_title` SET `mbt003` = 1 WHERE mbt001 IN ({$ids})";

        return MobileTitle::connection()->query($sql)
            ? $this->success('更新成功')
            : $this->fail('更新失敗');




    }

}