<?php
namespace pub;
use model\Member;
use model\Agent;

class GatewayApi {


    public function fail($message = 'Error', $params = array()) 
    {
        $params['status'] = false;
        $params['message'] = $message;
        return $params;
    }
    public function success($message = 'Success', $params = array()) 
    {
        $params['status'] = true;
        $params['message'] = $message;
        return $params;
    }
    public function page() 
    {
        /* 目前頁數 */
        return intval(\Input::post('page')) ?: 1;
    }
    public function rp() 
    {
        /* 每頁筆數 */
        return intval(\Input::post('rp')) ?: 10;
    }

    /**
     * 查詢 member 
     * @param  string   $query  查詢的手機號碼 or 會員姓名
     * @return array(<integer>) 查詢到的會員 id 陣列
     */
    public function findMember($query) {
        $options = array(
            'select' => 'mem001 AS id',
            'conditions' => array(
                'mem005 LIKE ? OR mem011 LIKE ? ',
                "%{$query}%",
                "%{$query}%"
            )
        );
        $values = array();
        foreach (Member::all($options) as $row) {
            $values[] = $row->id;
        }
        return $values ?: array(0);
    }

    /**
     * 查詢 agent 
     * @param  string   $query  查詢的手機號碼 or 成員姓名
     * @return array(<integer>) 查詢到的成員 id 陣列
     */
    public function findAgent($query) {
        $options = array(
            'select' => 'age001 AS id',
            'conditions' => array(
                'age004 LIKE ? OR age006 LIKE ? ',
                "%{$query}%",
                "%{$query}%"
            )
        );
        $values = array();
        foreach (Agent::all($options) as $row) {
            $values[] = $row->id;
        }
        return $values;
    }

}