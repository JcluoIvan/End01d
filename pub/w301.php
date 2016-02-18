<?php
use model\Agent;
use model\Post;

/* 取得門市資訊 */
class w301 {

    public function run() 
    {
        if (! User::isLogin()) {
            return array(
                'status' => true,
                'message' => '請先註冊並登入會員！！',
                'rows' => array()
            );
        }
        $pid = User::get('parent_agent') ?: null;
        $pid = $pid && count($pid) >= 2 ? $pid[1] : 0;

        # 取得上層 (展示中心) 
        $agent = Agent::find_by_age001($pid) ?: new Agent;

        # 是否開放瀏覽店家
        $unlocked = $agent->age025 ? 1 : 0;
        $options = array(
            'conditions' => array(
                "age002 = 'R' AND age016 = 0 AND (? OR age024 = 1 OR age001 = ?)",
                $unlocked,
                $pid
            ),
            'order' => 'age009',
        );
        
        $result = Agent::with(Agent::find('all', $options), array('parent'));
        $rows = array();
        foreach ($result as $row) {
            $parent = $row->parent ?: null;
            if ($parent === null || intval($parent->age016) == 1 || empty($row->age014)) {
                continue;
            }

            $pid = Post::row($row->age009, new Post)->pos002;
            $country = Post::row($pid, new Post)->pos004;

            if (! isset($rows[$country])) {
                $rows[$country] = array(
                    'country' => $country,
                    'rows' => array(),
                );
            }
            $rows[$country]['rows'][] = array(
                'id' => $row->age001,
                'name' => "{$row->age014}",
                'tel' => $row->age023 ?: '',
                'tal' => $row->age023 ?: '',
                'address' => $row->age010,
            );
        }

        return array(
            'status' => true,
            'message' => '',
            'rows' => array_values($rows)
        );


    }

}