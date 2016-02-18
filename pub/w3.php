<?php
use model\Post;
use model\Member;

/* 忘記密碼 */
class w3 {

    public function run() 
    {
        $phone = Input::post('phone') ?: null;
        $row = Member::find_by_mem011($phone) ?: null;

        if (empty($row)) {
            return array(
                'status' => false,
                'message' => Lang::get('sms.phoneError'),
            );
        }
        
        /* (len: 16)驗證碼: (len: 14)md5(datetime) + m + id */
        $row->mem029 = strtoupper(
            substr(md5(date('Ydmhis')), 0, 14).'m'.$row->mem001
        );

        $row->mem030 = date('Y-m-d H:i:s');

        $result = $row->save();
        if (! $result) {
            return array(
                'status' => false,
                'message' => Lang::get('sms.getCodeError'),
            );
        }

        $domain = System::get('url');
        $message = '不老神話密碼重設網址';
        $url = "{$domain}/page/reset.php?code={$row->mem029}";
        $content = $message.$url;
        $result = Sms::send($phone, $content) ?: array();

        return $result[0];
    }

}