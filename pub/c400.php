<?php
use model\News;
use model\AppRegister;
use model\Agent;
use model\Member;

class c400 {

    public function run() 
    {
        
        $type = Input::post('type');

        return $type == 'app' 
            ? $this->saveAppNotice()
            : $this->saveSmsNotice();
    }

    public function saveAppNotice() 
    {


        $id = Input::post('id');
        $news = News::find_by_new001($id) ?: new News;
        $news->new002 = 'app';
        $news->new003 = Input::post('title') ?: '';
        $news->new004 = Input::post('content') ?: '';
        $news->new005 = 'all'; // Input::post('notice_for') ?: '';
        $news->new006 = ''; // Input::post('users') ?: '';


        $image = isset($_FILES['image']) ? $_FILES['image'] : null;
        if (! empty($image['name'])) {
            $news->removeImage();
            $filename = explode ('.', $image['name']);
            $sub = array_pop($filename);
            $filename[] = time() . rand(1, 1000);
            $filename = md5(implode('', $filename)) . ".{$sub}";
            $path = Image::newsPath($filename);
            if (move_uploaded_file($image['tmp_name'], $path)) {
                $news->new008 = $filename;
            }
        }
        $result = $news->save();

        $notice = Input::post('notice') ?: false;

        $success = 0;
        $fail = 0;

        /* 執行推播通知 */
        if ($result && $notice) {
            AppRegister::pushNotification($news->new003);
        } else {
            $notice = false;
        }
        return array(
            'status' => $result,
            'message' => $result ? Lang::get('save.success') : Lang::get('save.fail'),
            'notice' => $notice ? true : false,
            'success' => $success,
            'fail' => $fail
        );
    }
   
    public function saveSmsNotice()
    {
        $sms_result = $this->sendSmsNotice();
        $error = array();

        foreach ($sms_result as $row) {
            if (empty($row['status']))
                $error[] = $row ?: '';
        }

        $id = Input::post('id');
        $news = News::find_by_new001($id) ?: new News;
        $news->new002 = 'sms';
        $news->new003 = ''; 
        $news->new004 = Input::post('content') ?: '';
        $news->new005 = Input::post('notice_for') ?: '';
        $news->new006 = Input::post('users') ?: '';
        $result = $news->save();
        
        return array(
            'status' => $result,
            'message' => $result ? Lang::get('save.success') : Lang::get('save.fail'),
        );
    }

    public function sendSmsNotice()
    {
        $notice_for = Input::post('notice_for') ?: '';
        $content = Input::post('content') ?: '';
        $users = Input::post('users') ?: 0;
        $rows = array();

        if ($notice_for == 'all')
            $rows = $this->getAllPhone() ?: array();
        else if ($notice_for == 'member')
            $rows = $this->getMembersPhone($users) ?: array();
        else
            $rows = $this->getAgentsPhone($users) ?: array();

        $send = Sms::send($rows, $content) ?: array();

        return $send;
    }

    public function getMembersPhone($users, $is_get_all = false)
    {
        $option = array(
            'conditions' => $is_get_all 
                ? 'mem014 != 1' 
                : "mem001 in ({$users})",
        );

        $members = $is_get_all ? Member::all($option) : Member::find('all', $option);
        $members = $members ?: array();

        $rows = array();
        $colums = array('phone');

        foreach ($members as $row) {
            $tmp = $row->attributes($colums) ?: array();
            $rows[] = $tmp['phone'];
        }

        return $rows;
    }

    public function getAgentsPhone($users, $is_get_all = false)
    {
        $option = array(
            'conditions' => $is_get_all 
                ? 'age002 in ("L", "R") AND age016 != 1'
                : "age001 in ({$users})",
        );

        $agents = $is_get_all ? Agent::all($option) : Agent::find('all', $option);
        $agents = $agents ?: array();

        $rows = array();
        $colums = array('phone');

        foreach ($agents as $row) {
            $tmp = $row->attributes($colums) ?: array();
            $rows[] = $tmp['phone'];
        }

        return $rows;
    }

    public function getAllPhone()
    {
        $members = $this->getMembersPhone(null, true) ?: array();
        $agents = $this->getAgentsPhone(null, true) ?: array();

        return array_merge($members, $agents);
    }


}