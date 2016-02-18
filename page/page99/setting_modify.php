<?php
    include '../../conf/config.php';
    use model\Setting;
    use model\Bank;

    $id = Input::get('id');

    $row = Setting::find_by_set001($id) ?: new Setting;


    if ($row->set001) {
        App::$tpl = $tpl;
        $method = "App::modify{$row->set002}";
        call_user_func_array($method, array($row));
    }


    $tpl->assign('setting', $row);
    $tpl->display('page99_setting_modify.tpl');


    class App {
        public static $tpl;
        public static function modifyBankAccount ($row) {

            $bank = array('code' => null, 'account' => null);

            if ($row->set004) {
                $data = explode('*', $row->set004 ?: '');
                $data[] = '';   /* 避免陣列大小只有 1, 在下一行發生錯誤 */
                list($bank['code'], $bank['account']) = $data;
            }
            static::$tpl->assign('codes', Bank::options());
            static::$tpl->assign('bank', $bank);
        }
        public static function modifyEmailNotice($row) {

            $data = json_decode($row->set004) ?: new stdClass;
            $emails = isset($data->emails) ? $data->emails : '';
            $disabled = empty($data->disabled) ? '' : 'checked';

            static::$tpl->assign('emails', $emails);
            static::$tpl->assign('disabled', $disabled);

        }
    }