<?php

namespace libraries\DataBase\ExtendPDO;
use PDO AS PDO;
use Exception AS Exception;
class ExtPDO extends PDO {
    // protected $query;
    // public function from($table /*, table2.... */ )
    // {
    //     $this->query->from = implode(',', func_get_args());
    //     return $this;
    // }


    public function __construct(
        $dsn, 
        $username = '', 
        $password = '',
        $options = array()
    ) {
        parent::__construct($dsn, $username, $password, $options);
        $this->setAttribute(
            PDO::ATTR_STATEMENT_CLASS, 
            array('\libraries\DataBase\ExtendPDO\ExtPDOStatement', array($this))
        );
    }

}