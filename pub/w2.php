<?php
use model\Post;

/* 縣市資料 */
class w2 {

    public function run() 
    {
        $pid = Input::post('pid') ?: 0;
        return array(
            'status' => true,
            'post' => Post::allArray()
        );

    }

}