<?php
namespace model;
use ActiveRecord\Model;
use Exception;
use System;
class AppRegister extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'app_register_id';

    // explicit pk since our pk is not "id"
    static $primary_key = 'ari001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    static $rp = 1000;

    public function registerDevice() 
    {
        $data = array(
            $this->ari001,  
            $this->ari002,  
            $this->ari003,
            $this->ari004,
        );
        if (
            empty($data[0]) || empty($data[1]) ||
            empty($data[2]) || empty($data[3])
        ) {
            throw new \Exception('App Register Error: ' . print_r($data, true));
        }

        $table = static::$table_name;

        $sql = "DELETE FROM `{$table}` WHERE `ari003` = ? ";
        $values = array($this->ari003);
        static::connection()->query($sql, $values);

        $sql = "REPLACE INTO `{$table}` 
                (`ari001`, `ari002`, `ari003`, `ari004`) VALUES (?, ?, ?, ?)";
        return static::connection()->query($sql, $data);

    }

    /**
     * 推播訊息
     * @param string                    $message
     *          傳送的訊息
     * @param  array<integer> | null    $users 
     *          傳訊息的對象, id 陣列, 
     *          若無輸入則推送給所有人   
     * @return [type]           [description]
     */
    public static function pushNotification($message, $users = null) 
    {
        $count = static::count(static::options(false, $users));
        $max = ceil($count / static::$rp);
        $success = 0;
        $fail = 0;
        for ($page = 0; $page < $max; $page++) {
            $rows = static::find('all', static::options(false, $users, $page));
            $rids = array();
            foreach ($rows as $row) {
                $rids[] = $row->rid;
            }
            $response = static::pushGCM($message, $rids);
            $success += intval($response->success);
            $fail += intval($response->failure);
        }

        $count = static::count(static::options(true, $users));
        $max = ceil($count / static::$rp);
        for ($page = 0; $page < $max; $page++) {
            $rows = static::find('all', static::options(true, $users, $page));
            $rids = array();
            foreach ($rows as $row) {
                $rids[] = $row->rid;
            }
            $response = static::pushIOS($message, $rids);
        }

    }
    /**
     * Google 的推播
     * @param  string           $message    推播訊息
     * @param  array<string>    $rids       register id 陣列
     * @return object          gcm server 回傳的結果
     */
    protected static function pushGCM($message, $rids) 
    {
        $url = System::get('gcm.url');
        $api_key = System::get('gcm.key');
        $fields = array(
            'registration_ids' => $rids,
            'data' => array('message' => $message),
        );
        $headers = array(
            "Authorization: key={$api_key}",
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);   
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === false) {
            throw new Exception('Curl failed : ' . curl_error($ch));
        }
        curl_close($ch);
        return json_decode($result);
    }
    /**
     * IOS 的推播
     * @param  string           $message 推播訊息
     * @param  array<string>    $rids    rgister id 陣列
     * @return boolean          
     */
    protected static function pushIOS($message, $rids) 
    {
        $passphrase = System::get('ios.push.passphrase');
        $payload = array(
            'aps' => array(
                'alert' => $message, 
                'badge' => 1, 
                'sound' => 'default'
            )
        );
        $output = json_encode($payload);
        
        $payload_length = strlen($output);

        $pem = System::get('ios.push.pem');
        $pwd = System::get('ios.push.passphrase');
        $stream = stream_context_create();
        stream_context_set_option($stream, 'ssl', 'local_cert', $pem);
        stream_context_set_option($stream, 'ssl', 'passphrase', $pwd);
        
        $host = System::get('ios.push.host');
        $error = null;
        $errorString = null;
        $apns = stream_socket_client(
            $host, 
            $error, 
            $errorString, 
            2, 
            STREAM_CLIENT_CONNECT, 
            $stream
        );
        foreach ($rids as $rid) {
            $message = 
                chr(0) . 
                pack('n', 32) . 
                pack('H*', $rid) . 
                pack('n', $payload_length) .
                $output;
            fwrite($apns, $message);
        }
        if ($error || $errorString) {
            // var_dump($result, $error, $errorString);
            return false;
        }
        fclose($apns);
        return true;


    }


    /**
     * 取得 AppRegister 資料
     * 由於 gcm 一次只接收 1000 設備推播, 所以一次 query 1000 筆資料
     * @param  boolean          $is_ios  設備類型是否為 ios, andriod 類統一用 gcm 推播
     * @param  array<integer>   $users   傳送的對象, 若為 null 則為全部
     * @param  integer          $page   頁數, 不輸入則回傳全部 (計算 count 用)
     * @return array    ActiveRecord Query Options 
     */
    protected static function options($is_ios, $users = null, $page = null) 
    {
        $where = array(
            ($is_ios ? "ari002 = 'ios'" : "ari002 != 'ios'")
        );
        
        if ($users) {
            $where[0] .= ' AND ari001 IN (?)';
            $where[] = $users;
        }
        $options = array('conditions' => $where);
        if ($page !== null) {
            $options['select'] = 'ari004 AS rid';
            $options['offset'] = $page * static::$rp;
            $options['limit'] = static::$rp;
        }
        return $options;
    }



}

