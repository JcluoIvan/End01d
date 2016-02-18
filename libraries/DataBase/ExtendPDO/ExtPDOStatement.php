<?php
namespace libraries\DataBase\ExtendPDO;
use \libraries\DataBase\DataResult AS DataResult;
use PDOStatement AS PDOStatement;
use ArrayObject AS ArrayObject;
use PDO AS PDO;

class ExtPDOStatement extends PDOStatement 
{ 
    protected $dbh;
    public function first($columns = null)
    {
        $result = $this->execute();
        return $columns === null 
            ? $this->fetch(PDO::FETCH_OBJ)
            : ($this->fetch(PDO::FETCH_OBJ)->$columns ?: null);
    }
    public function firstArray() 
    {
        $this->execute();
        return $this->fetch(PDO::FETCH_ASSOC);
    }
    
    public function get()
    {
        $this->execute();
        return $this->fetchAll(PDO::FETCH_OBJ);
    }
    public function getArray()
    {
        $this->execute();
        return $this->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function __construct($dbh) {
        $this->dbh = $dbh;
    }
}