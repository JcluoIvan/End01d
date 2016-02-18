<?php
    include '../../conf/config.php';
    use model\Agent;
    use model\Member;
    use model\LogAgent;
    use model\LogMember;
    $log = App::log();
    $tpl->assign('log', $log);
    $tpl->assign('user_name', App::userName($log));

    $tpl->display('page99_agent_view.tpl');


    class App {
        const TYPE_AGENT = 'agent';
        const TYPE_MEMBER = 'member';

        static function log() {

            $id = Input::get('id');
            $is_agent = (Input::get('type') == self::TYPE_AGENT);
            $log = null;

            if ($is_agent) {
                $log = LogAgent::with(
                    LogAgent::find_by_lag001($id),
                    array('agent')
                );
            } else {
                $log = LogMember::with(
                    LogMember::find_by_lmb001($id),
                    array('member')
                );
            }
            if (empty($log)) exit('資料不正確');

            return $log;
        }
        static function userName($log) {
            return (Input::get('type') == self::TYPE_AGENT)
                ? ($log->agent ? $log->agent->age006 : 'unknown')
                : ($log->member ? $log->member->mem005 : 'unknown');
        }

    }