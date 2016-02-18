<?php

include '../../conf/config.php';
use model\Agent;


$tables = array(
    'app_register_id',
    // 'agent_login',
    // 'member',
    'member_point_record',
    'order_manager',
    'order_detail',
    'order_reject',
    'order_swap',
    'product_inventory',
    // 'product_manager',
    // 'product_photo',
    'product_purchase',
    'product_purchase_detail',
    'product_inventory_detail',
    'radar_statement',
    'receipt',
    // 'video',
    'news',
    // 'log_agent',
    // 'log_error',
    // 'log_member',
    // 'log_order',
    // 'log_product',
    // 'log_purchase',
);

App::clearTable($tables);
App::resetMember();
$paths = array(
    // ROOT_PATH . 'photo/product/*.*',
    // ROOT_PATH . 'photo/qrcode/*.*',
    ROOT_PATH . 'photo/receipt/*.*',
);

App::removeFiles($paths);

App::finish();

class App {
    static function db() {
        return Agent::connection();
    }
    static function clearTable($tables) {
        // static::output('刪除表: ' . implode(', ', $tables));
        foreach ($tables as $table) {
            static::output('清空表: ' . $table);
            App::db()->query("TRUNCATE TABLE `{$table}`");
        }
        static::output('刪除資料表 ... ok ');
    }
    static function resetMember() {
        $sql = "UPDATE `member` SET mem021 = 0, mem023 = 0, mem024 = null, mem025 = null";
        App::db()->query($sql);
        static::output('會員資料重設 ... ok');
    }
    static function removeFiles($paths) {
        foreach ($paths as $path) {
            $files = glob($path);
            array_map('unlink', $files);
            static::output("刪除相關檔案 path = {$path} ... ok");
        }
    }
    static function finish() {
        echo '<script> parent.ClearApp.onsuccess(); </script>';
    }
    static function output($text) {
        echo "<script> parent.ClearApp.onresponse('{$text}');</script>";
        ob_flush();
        flush();
    }
}

