<?php
// 取得推薦人資料

use model\Agent;
use model\Member;

class w201 extends pub\GatewayApi{

    public function run()
    {
        $no = Input::get('no') ?: 0;
        $app = Input::get('app') ?: 0;
        $code = Input::get('code') ?: null;

        if ($app == 0) {
            return $this->downloadApp();
        }

        if (empty($code) || ! in_array($code[0], array('A', 'M'))) {
            return $this->fail('查無此推薦人資料');
        }

        $parent = $code[0] == 'A'
            ? Agent::find_by_age022($code)
            : Member::find_by_mem028($code);

        if ($parent) {

            $columns = array('id', 'no', 'account', 'name');
            $row = $parent->attributes($columns);
            $row['type'] = $parent instanceof Member ? 'M' : 'A';
            return $this->success('認證成功', array('parent' => $row ));

        } else {
            return $this->fail('查無此推薦人資料');
        }
    }
    public function downloadApp() {
        $app = 'endold.apk';
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"" . basename($app) . "\""); 
        readfile(URI::path($app)); // do the double-download-dance (dirty but worky)
    }
}