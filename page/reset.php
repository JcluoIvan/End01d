<?php
    include '../conf/config.php';
    use model\Member;
    $code = Input::get('code') ?: Input::post('code');
    $born = Input::post('born') ?: null;
    $new_password = trim(Input::post('new_password')) ?: null;
    $confirm_password = trim(Input::post('confirm_password')) ?: null;
    $message = null;

    $row = Member::find_by_mem029($code) ?: null;

    if (! $row) {
        alertMessage('查無認證碼');
        exit;
    }

    /* 驗證認證碼有效時間 */
    checkCodeValid($code);

    /* 驗證生日 */
    $check_born = checkBorn($code, $born);
    if (! $check_born) {
        $message = '生日錯誤';
        $born = null;
        $new_password = null;
    }

    $tpl->assign('code', $code);
    $tpl->assign('born', $born);

    /* 流程 3 - 更新密碼 */
    if (! empty($new_password)) {
        if ($new_password !== $confirm_password)
            $message = Lang::get('page01.validator.confirmPassword') ?: 'error';

        if (mb_strlen($new_password) < 4 || mb_strlen($new_password) > 16) 
            $message = '密碼長度 4 ~ 6';

        if (! $message) {
            $row->mem004 = $new_password;
            $row->mem029 = null;
            $result = $row->save();

            if ($result == 1) {
                alertMessage('設定成功');
                exit;
            }
            $message = '設定失敗';
        }
    }
    if ($message)
        alertMessage($message);

    /* 流程 2 - 輸入密碼 */
    if (! empty($born)) {
        $tpl->display('reset_password.tpl');
        exit;
    }

    /* 流程 1 - 輸入生日 */
    if (! empty($code)) {
        $tpl->display('reset_check_born.tpl');
        exit;
    }

    /**
     * 驗證認證碼有效時間
     * @if error will alert and exit
     */
    function checkCodeValid($code) 
    {
        $options = array(
            'select' => 'mem030 AS datetime, timediff(NOW(), mem030) AS valid',
            'conditions' => array('mem029 = ?', $code),
        );

        $row = Member::find('first', $options);

        if (! $row->datetime) {
            alertMessage('查無認證碼');
            exit;
        }

        if (
            intval(substr($row->valid, 0, 2)) >= 
            System::get('reset.valid')
        ) {
            alertMessage('認證碼已過期');
            exit;
        }
    }

    /**
     * 驗證生日
     * @return true or false
     */
    function checkBorn($code, $born)
    {
        if (! $born) return true;

        $options = array(
            'conditions' => array('mem007 = ? AND mem029 = ?', $born, $code),
        );

        $row = Member::find('first', $options) ?: null;

        return is_object($row) ? true : false;
    }


    function alertMessage($message) 
    {
        echo "<script>
                alert('{$message}');
            </script>";
    }

