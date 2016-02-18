<?php
use model\MobileTitle;
# mobile title image delete
class c9702 extends \pub\GatewayApi {

    public function run() 
    {
        $id = Input::post('id') ?: array();

        if ($row = MobileTitle::find_by_mbt001($id)) {

            if (! $row->delete()) {
                $this->fail('刪除失敗');
            }

            MobileTitle::sort('mbt004');
            return $this->success('刪除成功', array('id' => $id));

        }
        return $this->fail('資料錯誤，請重新操作');
    }

}