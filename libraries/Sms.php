<?php
namespace libraries;

/*
簡訊內容規則:
    1.urlencode(content)，不能big5
    2.轉為big5 問題字串'許公蓋銹'
        Notice:  iconv() [function.iconv]: Detected an illegal character in input string in C:\company\case edit\endold\endold-web-git\libraries\Sms.php on line 12
        簡訊內容第會傳兩封 第一封沒有許公蓋 第二封有(銹消失了)。
    3.重設密碼中，url 固定約59字元，中文字剩下33字元約(11個字)。
    4.全部中文字可超過180字元(60字)。
*/

class Sms {
    protected static function setData($tel, $content)
    {
        $smsData = array(
            'username' => System::get('sms.acc'),
            'password' => System::get('sms.pwd'),
            'type' => 'now',
            'encoding' => 'lbig5',
            'mobile' => $tel,
            'message' => urlencode($content),//urlencode(iconv('UTF-8', 'big5', $content)),
        );
        return $smsData;
    }

    public static function send($tels, $content)
    {
        $tels = is_array($tels) ? $tels : array($tels);
        $result = array();
        
        foreach ($tels as $key => $value) {
            $smsData = static::setData($value, $content) ?: array();
            $objPost = http_build_query($smsData);
            $strHeader = "Content-type: application/x-www-form-urlencoded\r\n";
            $aryOpts = array(
                'http' => array(
                    'method'   => 'POST',
                    'header'   => $strHeader."Content-Length:".strlen($objPost)."\r\n",
                    'content'  => $objPost
                )
            );
            $strContext = stream_context_create($aryOpts);
            $strContent = file_get_contents(System::get('sms.url'), false, $strContext);
            $xmlToObj = simplexml_load_string($strContent) ?: array();
            /* sms錯誤代碼 0000->成功, 其他再lang.php */
            $errorCode = strval($xmlToObj->code) ?: '0000';
            /* 結果 */
            $result[$key]['phone'] = $value ?: null;
            $result[$key]['status'] = $errorCode == '0000' ? true : false;
            $result[$key]['message'] = $errorCode == '0000' 
                ? '簡訊已發送' : Lang::get("sms.{$errorCode}");
        }
        return $result;
    }
}