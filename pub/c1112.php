<?php
// 指揮 雷達 新增修改

use model\Agent;
use model\Member;
use model\Store;

/*
驗證
    帳號
    密碼與確認密碼
    手機
    指揮站

*/

class c1112 extends pub\GatewayApi{

    public function run() {
         // 上層id
        $pid = Input::post('pid');
        
        // 修改的id (若沒有id則為新增)
        $id = Input::post('id');

        $parent = Agent::find_by_age001($pid) ?: new Agent;
        $agent = Agent::find_by_age001($id) ?: new Agent;

        $agent = $this->setAgentData($agent, $parent);

        $agent->validates();
        
        if (empty($agent->age001)) {
            $agent = $this->setAgentData($this->createNo($parent), $parent);
        }

        // 新增雷達 產生qrcode (若有pid 沒有 id 則為新增雷達站)
        if ($agent->save()) {
            $result = true;
            if ($agent->age002 !== 'L') {
                $result = $this->updateStore($agent);
            }
            return $result ? $this->success() : $this->fail('門市資訊儲存失敗');
        } else {
            return $this->fail(Lang::get('save.fail'));
        }
    }

    public function createNo($parent) 
    {
        return $parent->age003
            ? $this->createRadarNo($parent->age003, $parent->age001)
            : $this->createLeaderNo(); 
    }

    public function createLeaderNo() 
    {
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $agent = true;
        $num = 0;
        while ($agent) {
            $no = $str[rand(0, 25)] . $str[rand(0, 25)];
            $agent = Agent::find_by_age003($no) ?: false;

            if ($num > 5)
                return false;
            $num ++;
        }

        $sql = "INSERT INTO agent (age003)
                VALUES (:no)";

        $data = array(':no' => $no);

        Agent::connection()->query($sql, $data);
        $id = Agent::connection()->insert_id();

        return Agent::find_by_age001($id) ?: false;
    }

    public function createRadarNo($lNo, $lid)
    {
        $sql_max = "SELECT 
                        LPAD(
                            IFNULL(SUBSTR(MAX(age003), 3), 0) + 1, 3, 0
                        )
                    FROM agent AS age
                    WHERE age018 = :lid";

        $sql = "INSERT INTO agent (age003)
                VALUES (CONCAT(:no, ($sql_max)))";

        $data = array(':no' => $lNo, ':lid' => $lid);

        Agent::connection()->query($sql, $data);
        $id = Agent::connection()->insert_id();

        return Agent::find_by_age001($id) ?: false;
    }
    public function setAgentData($agent, $parent) {

        /* 新建立的帳號才能修改 */
        if (empty($agent->age004)) {
            $agent->age004 = Input::post('account');
        }
        
        $agent->age002 = $parent && $parent->age001 ? 'R' : 'L' ; // utp

        if (trim(Input::post('password'))) {
            $agent->age005 = trim(Input::post('password'));
        }
        $agent->age006 = Input::post('name');
        $agent->age008 = Input::post('born') ?: '';
        $agent->age009 = Input::post('city');
        $agent->age010 = Input::post('address');
        $agent->age011 = Input::post('bank_code') ?: ''; /* 銀行代號 */
        $agent->age012 = Input::post('phone');
        $agent->age013 = Input::post('email');
        $agent->age014 = Input::post('shopname');
        $agent->age015 = $agent->age015 ?: 0;
        $agent->age016 = $agent->age016 ?: 0; // isdesable
        $agent->age017 = Input::post('rebate') ?: ''; // 回饋%
        $agent->age018 = $parent ? $parent->age001 : 0; // lv1
        $agent->age019 = 0; // lv2
        $agent->age021 = Input::post('bank_account') ?: ''; // 銀行帳號
        $agent->age023 = Input::post('tel') ?: ''; // 門市電話

        $agent->addValidate('[name=password2]', 'age005', function($value) use($agent) {
            return (Input::post('password') !== Input::post('password2'))
                ? '兩次輸入的密碼不相同' : true;
        });

        return $agent;
    }

    public function updateStore($agent) {
        $result = true;
        $store = Store::find_by_sto001($agent->age001) ?: new Store;
        $store->sto001 = $agent->age001;
        $img = isset($_FILES['store_img']) ? $_FILES['store_img'] : null;
        if (! empty($img['name'])) {
            $filename = explode('.', $img['name']);
            $sub = array_pop($filename);
            $filename[] = time() . rand(1, 1000);
            $filename = md5(implode('', $filename)) . ".{$sub}";
            $path = Image::storePath($filename);
            $result = move_uploaded_file($img['tmp_name'], $path);
            if ($result && $store->imagePath()) {
                @unlink($store->imagePath());
            }
            $store->sto002 = $filename;
        }
        $store->sto003 = Input::post('store_map');
        $store->sto004 = Input::post('store_summary');
        $store->sto005 = Input::post('store_spending');
        $store->sto006 = Input::post('store_cursor');
        $store->sto007 = date('Y-m-d H:i:s');
        $store->sto008 = User::get('age006') . "(" . User::get('age004') . ")";
        return $result && $store->save();
    }
}