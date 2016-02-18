<?php
use model\Post;
use libraries\Captcha;
class c0 extends pub\GatewayApi {

    public function run() {

        $captcha = Input::post('captcha');
        $account = Input::post('account');
        $password = Input::post('password');

        if (! Captcha::check($captcha)) {
            return array(
                'status' => false,
                'validate' => array(
                    '[name=captcha]' => '驗證碼不正確'
                )

            );
        }
        $result = User::loginAgent($account, $password);
        switch($result) {
            case User::LOGIN_SUCCESS: 
                return array(
                    'status' => true,
                    'lang' => Lang::get(),
                    'postal' => Post::allArray(),
                    'user' => array(
                        'sid' => User::sid(),
                        'id' => User::get('id'),
                        'account' => User::get('account'),
                        'name' => User::get('name'),
                    ),
                );
            case User::LOGIN_WRONG: 
                return array(
                    'status' => false,
                    'validate' => array(
                        '[name=account]' => '帳號 or 密碼不正確',
                        '[name=password]' => '帳號 or 密碼不正確'
                    )
                );
            case User::LOGIN_DISABLED: 
                return array(
                    'status' => false,
                    'validate' => array(
                        '[name=account]' => '此帳號已停用。',
                    )
                );
            default:
                return array(
                    'status' => false,
                    'message' => '登入失敗！'
                );

        }
    }

}