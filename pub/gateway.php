<?php
    
    include '../conf/config.php';

    if (Input::get('site') === null) exit('site is null');
    if (Input::get('cmd') === null) exit('cmd is null');


    /* side = 0 為後台 C, 1 為 App 前台 W */
    $class_name = (intval(Input::get('site')) == 0 ? 'c' : 'w') . Input::get('cmd');
    $path = PUB_PATH . "{$class_name}.php";
    
    if (file_exists($path)) {

        include $path;

        if (class_exists($class_name)) {

            $class = new $class_name;

            $result = call_user_func_array(array($class, 'run'), array());
            
            if (is_array($result) || is_object($result)) {
                header('Content-Type:text/json; charset=utf-8');
                $result = json_encode($result);
            }
            exit($result);
        }

    }

