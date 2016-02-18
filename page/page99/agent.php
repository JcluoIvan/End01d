<?php

    include '../../conf/config.php';


    $tpl->assign('type_options', App::typeOptions());
    $tpl->display('page99_agent.tpl');


    class App {
        const TYPE_AGENT = 'agent';
        const TYPE_MEMBER = 'member';

        static function typeOptions() {
            return array(
                self::TYPE_AGENT => '部門、組織成員',
                self::TYPE_MEMBER => '會員',
            );
        }



    }