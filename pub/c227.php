<?php
use model\Video;

# video delete
class c227 extends pub\GatewayApi{
    public function run()
    {

        $vid = Input::post('vid');
        if ($video = Video::find_by_vdo001($vid)) {

            return $video->delete()
                ? $this->success('刪除成功')
                : $this->fail('刪除失敗');
        }
        return $this->fail('資料不正確, 刪除失敗');

    }
}