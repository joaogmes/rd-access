<?php

require_once(app . '/core/Dao.php');

class AccessModel
{

    private $table = "Access";
    private $dao;

    public function __construct()
    {
        $this->dao = new Dao($this->table);
    }

    public function list()
    {
        return $this->dao->listEntities();
    }

    public function get($key, $value){
        return $this->dao->getEntity($key, $value);
    }

    public function create(){
        return $this->dao->inserEntity();
    }

    public function runQuery($query){
        return $this->dao->query($query);
    }
    
    public function runQueryInsert($query){
        return $this->dao->queryInsert($query);
    }
}
