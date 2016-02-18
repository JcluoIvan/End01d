<?php
return array(

    /* common */
    'login' => array(
        'success' => '登入成功',
        'error' => '錯誤的帳號 or 密碼',
        'disabled' => '帳號已停用/除帳',
        'timeout' => '登入資訊已過期, 請重新登入'
    ),
    'save' => array(
        'success' => '儲存成功',
        'fail'  => '儲存失敗',
    ),

    'order' => array(
        'error' => 'Error',
    ),

    'validate' => array(
        'length' => "字串長度必需在 %s 至 %s 之間",
        'integer' => '必需是整數',
        'between' => '數值必需在 %s 至 %s 之間',
        'in' => '資料必需為 %s 其中一項',
        'required' => '此欄位為必填',
    ),

    'page01' => array(
        'validator' => array(
            'age002' => '權限錯誤',
            'age004' => '帳號不能為空或重複',
            'age005' => '密碼不能為空或確認密碼錯誤',
            'age006' => '姓名不能為空',
            'age012' => '手機不能為空或重複',
            'age018' => '專業經理人比對錯誤',
            'mem011' => '手機不能為空或重複',
            'mem004' => '密碼不能為空或確認密碼錯誤',
            'mem005' => '姓名不能為空',
            'mem017' => '展示中心比對錯誤',
            'phoneLength' => '必需為 10 個數字',
            'confirmPassword' => '兩次輸入的密碼不正確',
            'uniquePhone' => '此手機號碼已註冊過',
        ),
    ),

    /* page02 (news) */
    'page02' => array(
        'validator' => array(
            'pdm002' => '產品序號不能為空',
            'pdm004' => '未填產品名稱',
            'pdm005' => '未填售價',
            'pdm006' => '未填會員價',
            'pdi002' => '類別名稱不能為空會重複',
            'pdp002' => '產品比對錯誤',
            'pdp003' => '未填進貨數量',
            'pdp004' => '展示中心比對錯誤',
            'pdp005' => '未填進貨單號',

        ),
    ),

    /* page04 (news) */
    'page04' => array(
        'validator' => array(
            'new002' => '「通知」方法的資料不正確',
        ),
    ),
    'sms' => array(
        'phoneError' => '查無手機號碼',
        'getCodeError' => '取得驗證碼失敗',
        '00010' => '簡訊帳號密碼錯誤',
        '00100' => '手機號碼錯誤',
        '00130' => '超過規定字數(包括標點符號)，中文字為70字元，英文字159字元',
    ),
);
