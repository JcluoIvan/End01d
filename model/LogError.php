<?php
namespace model;
use User;
use URI;

class LogError extends BaseModel
{
    // explicit table name since our table is not "books"
    static $table_name = 'log_error';

    // explicit pk since our pk is not "id"
    static $primary_key = 'ler001';

    // explicit connection name since we always want production with this model
    static $connection = 'production';

    // explicit database name will generate sql like so => db.table_name
    // static $db = 'endol';

    static $has_to = array(
        'member' => array('Member', 'mem001', 'ler004', 'single'),
    );

    static $attribute_transform = array(
        'ler001' => 'id',
        'ler002' => 'time',
        'ler003' => 'path',
        'ler004' => 'mid',
        'ler005' => 'type',
        'ler006' => 'caption',
        'ler007' => 'content',
    );

    public static function errorHandler() 
    {
        if (func_num_args() === 0) return true;

        $no = 0;
        $caption = null;
        $line = null;
        $file = null;
        $trace = null;

        if (func_num_args() === 1 && is_object(func_get_arg(0))) {
            $obj = func_get_arg(0);
            $caption = $obj->getMessage();
            $file = $obj->getFile();
            $line = $obj->getLine();
            $trace = $obj->getTrace();
        } else {
            list(
                $no,
                $caption,
                $file,
                $line,
                $trace
            ) = func_get_args();
            
        }
        var_dump($trace);
        exit;
        $content = array();
        if (is_array($trace)) {
            foreach($trace as $t) {
                if (is_array($t)) unset($t['args']);
                $content[] = $t;
            }
        }

        $detail = implode("\n", array(
            "File: {$file} , on line : {$line}",
            print_r($content, true),
        ));

        $user = User::data();
        $log = new LogError;
        $log->ler003 = URI::segmentString();
        $log->ler004 = $user ? json_encode($user->attributes(true)) : null;
        $log->ler005 = static::errorType($no);
        $log->ler006 = $caption;
        $log->ler007 = $detail;

        $log->save();
    }

    public static function errorType($type) 
    {
        switch ($type) {
            case 0:
                return 'EXCEPTION';
            case E_ERROR: // 1 //
                return 'E_ERROR';
            case E_WARNING: // 2 //
                return 'E_WARNING';
            case E_PARSE: // 4 //
                return 'E_PARSE';
            case E_NOTICE: // 8 //
                return 'E_NOTICE';
            case E_CORE_ERROR: // 16 //
                return 'E_CORE_ERROR';
            case E_CORE_WARNING: // 32 //
                return 'E_CORE_WARNING';
            case E_CORE_ERROR: // 64 //
                return 'E_COMPILE_ERROR';
            case E_CORE_WARNING: // 128 //
                return 'E_COMPILE_WARNING';
            case E_USER_ERROR: // 256 //
                return 'E_USER_ERROR';
            case E_USER_WARNING: // 512 //
                return 'E_USER_WARNING';
            case E_USER_NOTICE: // 1024 //
                return 'E_USER_NOTICE';
            case E_STRICT: // 2048 //
                return 'E_STRICT';
            case E_RECOVERABLE_ERROR: // 4096 //
                return 'E_RECOVERABLE_ERROR';
            case E_DEPRECATED: // 8192 //
                return 'E_DEPRECATED';
            case E_USER_DEPRECATED: // 16384 //
                return 'E_USER_DEPRECATED';
            default:
                return 'UNKNOWN';
        }

    }
    
}

