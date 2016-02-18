<?php
use model\News;


/* 刪除指揮站圖片 */
class c403 extends pub\GatewayApi{

    public function run() {

        $id = Input::post('id') ?: 0;

        $news = News::find_by_new001($id);
        if (! empty($news)) {
            return $news->removeImage()->save()
                ? $this->success()
                : $this->fail('刪除失敗');
        }
        return $this->fail('資料錯誤, 刪除失敗');

    }

}