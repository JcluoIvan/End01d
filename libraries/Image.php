<?php
namespace libraries;
/**
 * How to Use
 *     $from_path = "{path}\Desert.jpg";
 *     $to_path = "{path}\Desert.min.jpg";  
 *     Image::resize($from_path, $to_path, 320, 240) ? 'success' : 'fail';
 */
class Image {
    protected static $allow_format = array('jpeg', 'png', 'gif');
    public static function resize($from_path, $save_path, $in_width = 480, $in_height = 480, $quality = 100) 
    {
        $info = getimagesize($from_path);
        list($width, $height, $img_type, $img_tag) = $info;
        $bits = $info['bits'];
        $mime = $info['mime'];

        list($t, $sub_name) = explode('/', $mime);

        $sub_name = $sub_name == 'jpg' ? 'jpeg' : $sub_name;

        if (! in_array($sub_name, static::$allow_format)) {
            return false;
        }

        $percent = static::getResizePercent($width, $height, $in_width, $in_height);

        $new_width  = $width * $percent;
        $new_height = $height * $percent;

        $image_new = imagecreatetruecolor($new_width, $new_height);

        $image = static::imageCreateFrom($sub_name, $from_path);

        imagecopyresampled($image_new, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        return imagejpeg($image_new, $save_path, $quality);

    }

    private static function imageCreateFrom($type, $path) 
    {
        switch ($type) {
            case 'jpeg':
                return imagecreatefromjpeg($path);
            case 'gif':
                return imagecreatefromgif($path);
            case 'png':
                return imagecreatefrompng($path);
        }
    }

    private static function getResizePercent($source_w, $source_h, $inside_w, $inside_h)
    {
        if ($source_w < $inside_w && $source_h < $inside_h) {
            return 1; // Percent = 1, 如果都比預計縮圖的小就不用縮
        }

        $w_percent = $inside_w / $source_w;
        $h_percent = $inside_h / $source_h;

        return ($w_percent > $h_percent) ? $h_percent : $w_percent;
    }
    // 儲存qrcode檔案的路進
    public static function qrcodePath($filename = '') {

        return ROOT_PATH . "photo/qrcode/{$filename}";
    }
    // 存DB qrcode的路徑 (取得檔案的路徑)
    public static function qrcodeUrl($filename = '') {

        return System::get('url') . "/photo/qrcode/{$filename}";
    }

    // 儲存產品圖片檔案的路進
    public static function productPath($filename = '') {

        return ROOT_PATH . "photo/product/{$filename}";
    }
    // 存DB 產品圖片的路徑 (取得檔案的路徑)
    public static function productUrl($filename = '') {

        return System::get('url') . "/photo/product/{$filename}";
    }

    // 儲存統一發票圖片檔案的路徑
    public static function receiptPath($filename = '') {
        return ROOT_PATH . "photo/receipt/{$filename}";
    }
    // 存DB 統一發票圖片的路徑 (取得檔案的路徑)
    public static function receiptUrl($filename = '') {
        return System::get('url') . "/photo/receipt/{$filename}";
    }
    // 產生最新消息圖片檔案的路徑
    public static function newsPath($filename = '') {
        return ROOT_PATH . "photo/news/{$filename}";
    }
    // 產生最新消息網址 
    public static function newsUrl($filename = '') {
        return System::get('url') . "/photo/news/{$filename}";
    }

    /** 手機 App Title 圖片 */
    public static function mobileTitlePath($filename = '' ) {
        return ROOT_PATH . "/photo/mobile/title/{$filename}";
    }
    public static function mobileTitleUrl($filename = '' ) {
        return System::get('url') . "/photo/mobile/title/{$filename}";
    }

    /** 商家資訊圖片 */
    public static function storePath($filename = '' ) {
        return ROOT_PATH . "/photo/store/{$filename}";
    }
    public static function storeUrl($filename = '' ) {
        return System::get('url') . "/photo/store/{$filename}";
    }
}