<?php
use model\MobileTitle;
# mobile title image update
class c9700 extends \pub\GatewayApi {

    public function run() 
    {
        $images = isset($_FILES['images']) ? $_FILES['images'] : array();
        $success = 0;
        $fail = 0;
        foreach ($images['name'] as $i => $name) {
            if (empty($images['size'][$i])) continue;
            $filename = explode('.', $name);
            $sub = array_pop($filename);
            $filename[] = time() . rand(1, 1000);
            $filename = md5(implode('', $filename)) . ".{$sub}";
            $path = Image::mobileTitlePath($filename);
            $result = move_uploaded_file($images['tmp_name'][$i], $path);
            $row = new MobileTitle;
            $row->mbt002 = $filename;
            if ($row->save()) {
                $success ++;
            } else {
                $fail ++;
            }
        }

        MobileTitle::sort('mbt004');
        return $fail === 0
            ? $this->success()
            : $this->fail();

    }

}