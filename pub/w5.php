<?php
use model\MobileTitle;
# mobile title list
class w5 extends \pub\GatewayApi {

    public function run() 
    {
        $options = array(
            'conditions' => array('mbt003 = 1'),
            'order' => 'mbt004'
        );

        $images = array_map(function($row) {
            return $row->url();
        }, MobileTitle::all($options));

        return $this->success('success', array(
            'images' => $images ?: array()
        ));

 
    }

}