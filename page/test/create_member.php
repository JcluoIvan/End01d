<?php
    set_time_limit(0);
    include '../../conf/config.php';
    include '../../pub/c105.php';
    use model\Member;
    use model\Agent;

    if (Input::post()) {

        $rid = Input::post('rid');
        $agent = Agent::find_by_age001($rid);
        $lv = intval(Input::post('lv'));
        $count = intval(Input::post('count'));

        // $t = $lv * $count;
        // for($i = 0; $i < $t; $i++) {
        //     echo "{$i} / {$t}";
        //     ob_flush();
        //     flush();
        //     sleep(1);
        // }
        // ob_end_flush();
        // exit('end');
        $total = 0;
        for ($i = 0; $i < $lv; $i++) {
            $total += pow($count, $i + 1);
        }
        CreateMember::$total = $total;
        CreateMember::create($agent->age018, $agent->age001, $lv, $count);
        exit('success');

    }

    $options = array('conditions' => "age002 = 'R' AND age016 = 0");
    $rows = Agent::find('all', $options);
    $agents = array();
    foreach ($rows as $row) {
        $agents[$row->age001] = $row->age006;
    }


    $rid = Input::get('rid') ?: false;
    if (! $rid) {
        list($rid) = array_keys($agents);
    }

    $options = array(
        'conditions' => array('mem017 = ? AND mem014 = 0', $rid ),
        'order' => 'mem018, mem019, mem020'
    );
    $result = Member::find('all', $options);

    $tree = array();
    $map = array();

    foreach ($result as $row) {
        $data = $row->attributes(array('id', 'name', 'phone'));
        $data['children'] = array();
        $map[$row->mem001] = $data;
        if (intval($row->mem020) == 0) {
            $tree[] = &$map[$row->mem001];
        } else {
            $map[$row->mem020]['children'][] = &$map[$row->mem001];
        }
    }
    // out($tree);
    // function out($rows) {
    //     echo '<ul>';
    //     foreach ($rows as $row) {
    //         echo "<li><label>{$row['name']}</label>";
    //         count($row['children']) && out($row['children']);
    //         echo '</li>';
    //     }
    //     echo '</ul>';
    // }
    
    $tpl->assign('members', $tree);
    $tpl->assign('agents', $agents);
    $tpl->display('test_create_member.tpl');

    class CreateMember {
        public static $fname = '趙錢孫李周吳鄭王馮陳褚衛蔣沈韓楊朱秦尤許何呂施張孔曹嚴華金魏陶姜戚謝鄒喻柏水竇章雲蘇潘葛奚范彭郎魯韋昌馬苗鳳花方俞任袁柳酆鮑史唐費廉岑薛雷賀倪湯滕殷羅畢郝鄔安常樂于時傅皮卞齊康伍余元卜顧孟平黃和穆蕭尹姚邵湛汪祁毛禹狄米貝明臧計伏成戴談宋茅龐熊紀舒屈項祝董梁杜阮藍閔席季麻強賈路婁危江童顏郭梅盛林刁鐘徐丘駱高夏蔡田樊胡凌霍虞萬支柯昝管盧莫經房裘繆干解應宗丁宣賁鄧郁單杭洪包諸左石崔吉鈕龔程嵇邢滑裴陸榮翁荀羊於惠甄麴家封芮羿儲靳汲邴糜松井段富巫烏焦巴弓牧隗山谷車侯宓蓬全郗班仰秋仲伊宮寧仇欒暴甘鈄厲戎祖武符劉景詹束龍葉幸司韶郜黎薊薄印宿白懷蒲邰從鄂索咸籍賴卓藺屠蒙池喬陰鬱胥能蒼雙聞莘黨翟譚貢勞逄姬申扶堵冉宰酈雍郤璩桑桂濮牛壽通邊扈燕冀郟浦尚農柴瞿閻充慕連茹習宦艾魚容向古易慎戈廖庾終暨居衡步都耿滿弘匡國文寇廣祿闕東歐殳沃利蔚越夔隆師鞏厙聶晁勾敖融冷訾辛闞那簡饒空曾毋沙乜養鞠須豐巢關蒯相查后荊紅游竺權逯蓋益桓公萬俟司馬上官歐陽夏候諸葛聞人東方赫連皇甫尉遲公羊澹台公治宗政濮陽淳于單于太叔申屠公孫仲孫轅軒令狐鐘離宇文長孫幕容鮮于閭丘司徒司空丌官司寇仉督子車顓孫端木巫馬公西漆雕樂正壤駟公良拓拔夾谷宰父穀梁晉楚閻法汝鄢涂欽段干百里東郭南門呼延歸海羊舌微生岳帥緱亢況後有琴梁丘左丘東門西門商牟佘佴佰賞南官墨哈譙笪年愛陽佟第五言福百家姓終';
        public static $time = 0;
        public static $total = 0;
        public static $count = 0;
        public static function name() {
            $idx = rand(0, mb_strlen(static::$fname));
            return mb_substr(static::$fname, $idx, 1) . (rand(0, 1) ? '小姐' : '先生');
        }
        public static function check() 
        {
            static::$count ++;
            $t = time();
            if (static::$time != $t) {
                echo static::$count . " / " . static::$total;
                static::$time = $t;
                ob_flush();
                flush();
            }

        }
        public static function create($lid, $rid, $lv, $count, $row = null) {
            if ($lv <= 0) return;

            for ($i = 0; $i < $count; $i++) {

                $phone = '';
                $bool = true;
                while ($bool) {
                    $phone = '09';
                    $phone .= str_pad(rand(0,9999), 4, '0', STR_PAD_LEFT);
                    $phone .= str_pad(rand(0,9999), 4, '0', STR_PAD_LEFT);
                    $options = array(
                        'conditions' => array('mem011 = ?', $phone)
                    );
                    $bool = intval(Member::count($options)) > 0;
                }
                $member = new Member;
                $account = rand(0, 999);

                $member->mem002 = $phone;
                $member->mem003 = $phone;
                $member->mem004 = '0000';
                $member->mem005 = static::name();
                $member->mem006 = $phone;
                $member->mem007 = date('Y/m/d');
                $member->mem008 = '';
                $member->mem009 = '';
                $member->mem010 = '';
                $member->mem011 = $phone;
                $member->mem012 = '';
                $member->mem013 = 0;
                // $member->mem014 = '';
                $member->mem015 = System::get('member_point_percent');
                $member->mem016 = $lid;
                $member->mem017 = $rid;
                $member->mem018 = $row ? $row->mem019 : 0;
                $member->mem019 = $row ? $row->mem020 : 0;
                $member->mem020 = $row ? $row->mem001 : 0;
                $member->mem021 = 0;
                $member->mem022 = '';
                // $member->mem023 = '';
                // $member->mem024 = '';
                // $member->mem025 = '';
                // $member->mem026 = '';
                $member->mem028 = Member::createQRCodeID();
                if (! $member->save()) {
                    var_dump($member->getError());
                } else {
                    $member->createQRCode()
                    static::check();
                    static::create($lid, $rid, $lv - 1, $count, $member);
                }
            }

        }
    }