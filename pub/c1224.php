<?php
use model\Product;
use model\Agent;
class c1224 {

    public function run() {

        $item = Input::post('item');
        $rows = array();
        switch ($item) {
            case 'all':
                $rows['build'] = '建立日期';
                $rows['reject'] = '退貨日期';
                $rows['check'] = '核帳日期';
                $rows['cannel'] = '註銷日期';
                break;
            case 'RN':
                $rows['build'] = '建立日期';
                break;
            case 'RY':
                $rows['build'] = '建立日期';
                $rows['reject'] = '退貨日期';
                break;
            case 'N':
                $rows['build'] = '建立日期';
                $rows['reject'] = '退貨日期';
                break;
            case 'Y':
                $rows['build'] = '建立日期';
                $rows['reject'] = '退貨日期';
                $rows['check'] = '核帳日期';
                break;
            case 'cannel':
                $rows['cannel'] = '註銷日期';
                break;
            default:
                # code...
                break;
        }

        return array(
            'status' => true,
            'rows' => $rows,
        );
    }


}