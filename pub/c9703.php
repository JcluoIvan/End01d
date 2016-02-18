<?php
use model\MobileTitle;
# mobile title image sort update
class c9703 extends \pub\GatewayApi {

    public function run() 
    {
        $id = Input::post('id') ?: array();
        $sort = Input::post('sort') ?: 0;
        if ($row = MobileTitle::find_by_mbt001($id)) {
            $row->mbt004 = $sort;
            if (!$row->save()) {
                return $this->fail('刪除失敗');
            }

            MobileTitle::sort('mbt004');
            $row = MobileTitle::find_by_mbt001($id);
            return $this->success('刪除成功', array('id' => $id, 'sort' => $row->mbt004 / 10));

        }
        return $this->fail('資料錯誤，請重新操作');
    }

}