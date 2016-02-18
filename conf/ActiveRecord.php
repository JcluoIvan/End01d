<?php
if (!defined('PHP_VERSION_ID') || PHP_VERSION_ID < 50300)
    die('PHP ActiveRecord requires PHP 5.3 or higher');

define('PHP_ACTIVERECORD_VERSION_ID','1.0');

require LIBRARIES_PATH . 'ActiveRecord/Singleton.php';
require LIBRARIES_PATH . 'ActiveRecord/Config.php';
require LIBRARIES_PATH . 'ActiveRecord/Utils.php';
require LIBRARIES_PATH . 'ActiveRecord/DateTime.php';
require LIBRARIES_PATH . 'ActiveRecord/Model.php';
require LIBRARIES_PATH . 'ActiveRecord/Table.php';
require LIBRARIES_PATH . 'ActiveRecord/ConnectionManager.php';
require LIBRARIES_PATH . 'ActiveRecord/Connection.php';
require LIBRARIES_PATH . 'ActiveRecord/SQLBuilder.php';
require LIBRARIES_PATH . 'ActiveRecord/Reflections.php';
require LIBRARIES_PATH . 'ActiveRecord/Inflector.php';
require LIBRARIES_PATH . 'ActiveRecord/CallBack.php';
require LIBRARIES_PATH . 'ActiveRecord/Exceptions.php';


$conn = $db_config['write'];
$connections = array(
    'development' => 'mysql://invalid',
    'production' => "mysql://{$conn['username']}:{$conn['password']}@{$conn['host']}/{$conn['dbname']};charset=utf8"
);   
ActiveRecord\Config::initialize(function($cfg) use ($connections)
{
    $cfg->set_model_directory('.');
    $cfg->set_connections($connections);
});


// spl_autoload_register('activerecord_autoload');

// function activerecord_autoload($class_name)
// {
//     $path = ActiveRecord\Config::instance()->get_model_directory();
//     $root = realpath(isset($path) ? $path : '.');

//     if (($namespaces = ActiveRecord\get_namespaces($class_name)))
//     {
//         $class_name = array_pop($namespaces);
//         $directories = array();

//         foreach ($namespaces as $directory)
//             $directories[] = $directory;

//         $root .= DIRECTORY_SEPARATOR . implode($directories, DIRECTORY_SEPARATOR);
//     }

//     $file = "$root/$class_name.php";

//     if (file_exists($file))
//         require $file;
// }
