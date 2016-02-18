<?php
use model\Video;

# video save
class c226 extends pub\GatewayApi{
    public function run()
    {

        $vid = Input::post('video_id');

        $video = Video::find_by_vdo001($vid) ?: new Video;
        $video->vdo002 = Input::post('pid');
        $video->vdo003 = Input::post('video_title');
        $video->vdo004 = Input::post('video_no');

        return $video->save()
            ? $this->success('儲存成功')
            : $this->fail('儲存失敗');

    }
}