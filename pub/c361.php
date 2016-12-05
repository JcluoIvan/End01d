<?php
use model\Order;
use model\AppRegister;
use model\Setting;
class c361 extends pub\GatewayApi {

    public function run()
    {
        $rows = Order::with(
            Order::all($this->options()),
            array('member')
        );

        $today = date('Y/m/d');
        exit($today);
        /* 是否推播通知 */
        $app_push = Setting::value('GrantNoticeByApp', 0) ? true : false;
        foreach ($rows as $row) {

            $row->odm031 = $today;
            $point = $row->getMemberPoint();
            $row->recalculateMemberPoint();
            $member_name = $row->member ? $row->member->mem005 : '下層會員';
            $fname = mb_substr($member_name, 0, 1, 'utf8');
            $message = "會員 {$fname}(先生/小姐) 購物本公司產品，您將獲得購物金 {$point}。";
            $members = array(
                $row->odm013,
                $row->odm023,
                $row->odm024,
                $row->odm025
            );
            ($app_push) && AppRegister::pushNotification($message, $members);
            $row->recalculateMemberPoint();
            $row->save();
        }
        // $sql = 'UPDATE order_manager SET odm031 = ? WHERE odm006 = ? AND odm031 is null';
        // $values = array(date('Y/m/d'), $this->date());

        // $result = Order::connection()->query($sql, $values);
        return $this->success();

    }

    public function date() {
        $clearing = System::get('clearing_date');
        $days = intval(Input::post('days')) ?: 0;
        if ($days < $clearing) {
            exit(json_encode($this->fail("交易未滿 {$clearing} 天，不能結算")));
        }
        $date = new DateTime;
        $date->sub(new DateInterval("P{$days}D"));
        return $date->format('Y/m/d');
    }

    public function options()
    {
        $options = array(
            'conditions' => array('odm006 = ? AND odm005 IS NOT NULL AND odm031 IS NULL', $this->date()),
        );
        return $options;
    }


}