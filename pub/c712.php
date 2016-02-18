<?php
/* 奨金核銷 */

use model\Bonus;
use model\Order;

class c712 {
    public function run() {
        $aid = Input::post('aid') ?: 0;
        $date1 = Input::post('date1') ?: null;
        $date2 = Input::post('date2') ?: null;
        $oid = Input::post('oid') ?: null;
        $operate = User::get('id') ?: 0;

        $oid = explode(',', $oid);

        foreach ($oid as $value) {
            if (! $value)
                continue;

            $options = array(
                'conditions' => array('bon002 = ? AND bon003 = ? ', $value, $aid)
            );
            
            $bonus = Bonus::first($options) ?: new Bonus;

            $bonus->bon002 = $bonus->bon002 ?: $value;
            $bonus->bon003 = $bonus->bon003 ?: $aid;
            $bonus->bon004 = date('Y-m-d');
            $bonus->bon005 = $operate ?: 0;
            $bonus->save();
        }
        return true;
    }

}