<?php
include '../conf/config.php';
use model\Order;
use model\MemberPointRecord;
use model\Member;

foreach (Member::all() as $member) {

    $options = array(
        'conditions' => array(
            'mpr002 = ?', array($member->mem001)
        )
    );
    $points = MemberPointRecord::all($options);
    foreach ($points as $r) {
        
        if ($r->mpr003 !== 'order') continue;
        $order = Order::find_by_odm001($r->mpr004);

        if (empty($r->mpr006)) {
            if (empty($order)) $r->delete();
        } else {
            if (empty($ordre->odm041)) {
                $order->save();
            }

        }
    }
}

exit('success');