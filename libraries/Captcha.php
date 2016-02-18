<?php
namespace libraries;
class Captcha {
    
    const SESSION_KEY =  'endold.captcha';

    static function check($text) 
    {
        return isset($_SESSION[self::SESSION_KEY]) && 
            $_SESSION[self::SESSION_KEY] === strval($text);
    }

    private static function captchaText() 
    {
        $text = '';
        for ($i = 0; $i < 6; $i++) {
            $text .= rand(0, 9);
        }

        $_SESSION[self::SESSION_KEY] = strval($text);
        return $text;

    }


    static function renderImage() {
        header('Content-Type: image/jpeg');

        /* 產生畫布 */
        $img_width = 120;
        $img_height = 30;

        $source_width = 120;
        $source_height = 15;
        $tmp = imagecreatetruecolor($source_width, $source_height);
        $white = imagecolorallocate($tmp, 220, 220, 220);
        imagefill($tmp, 0, 0, $white);
        
        /* 產生驗證碼 */
        $text = static::captchaText();
        foreach (str_split($text) as $i => $char) {
            imagestring(
                $tmp,
                5,
                $i * 20 + 5, //+ rand(0, 10), 
                // rand(0, 10),
                0,
                $char,
                imagecolorallocate($tmp, rand(0, 190), rand(0, 190), rand(0, 190))
            );
        }

        /* 放大數字 */
        $img = imagecreatetruecolor($img_width, $img_height);
        imagecopyresampled($img, $tmp, 0, 0, 0, 0, $img_width, $img_height, $source_width, $source_height);
        imagedestroy($tmp);

        /* 繪入文字雜訊-線條*/
        // for ($i = 0; $i < 5; $i++) { //5條
        //     imageline(
        //         $img, 
        //         0, 
        //         rand() % $img_height, 
        //         $img_width, 
        //         rand() % $img_height, 
        //         imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255))  
        //     );
        // }
        /* 繪入文字雜訊-點 */
        // for ($i = 0; $i < 100; $i++) {    //50點
        //     imagesetpixel(
        //         $img, 
        //         rand() % $img_width, 
        //         rand() % $img_height, 
        //         imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255))  
        //     );
        // }
        imagejpeg($img);
        imagedestroy($img);
        exit;
    }

}