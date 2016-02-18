<?php
namespace libraries\DataBase;

use ArrayObject AS ArrayObject;
use PDO AS PDO;
use Timer AS Timer;
class DataResult extends ArrayObject {

    public function __get($key) 
    {
        return $this->offsetExists($key) ? $this->offsetGet($key) : null;
    }
    public function __set($key, $value)
    {
        $this->offsetSet($key, $value);
    }

    public function __construct($input = array(), $flags = 0, $iterator_class = 'ArrayIterator') 
    {
        $value = array_slice($input, 0, 1);
        if (isset($value[0]) && is_array($value[0])) {
            Timer::log('Query End : ');
            foreach ($input as &$value) {
                is_array($value) && $value = new self($value);
            }
        }
        parent::__construct($input, $flags, $iterator_class);

        // if (count($input) == 1000) {
        //     Timer::start();
        // }
        // foreach ($this as $key => $value) {
        //     if (is_array($value)) {
        //         $this->$key = new DataResult($value);
        //     }
        // }
        // if (count($input) == 1000) {
        //     Timer::log();
        // }
    }
}
