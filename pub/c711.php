<?php
/* 奨金核銷 */

use model\Bonus;

class c711 {
    public function run() {
        $oid = Input::post('oid') ?: 0;
        $aid = Input::post('aid') ?: 0;
        $date = Input::post('date') ?: date('Y-m-d');
        $operate = User::get('id') ?: 0;

        $bonus = new Bonus;

        $options = array(
            'conditions' => array('bon002 = ? AND bon003 = ? ', $oid, $aid)
        );

        $bonus = Bonus::first($options) ?: new Bonus;

        $bonus->bon002 = $bonus->bon002 ?: $oid;
        $bonus->bon003 = $bonus->bon003 ?: $aid;
        $bonus->bon004 = $date ?: null;
        $bonus->bon005 = $operate ?: 0;

        $bonus->save();

        return true;
    }

}