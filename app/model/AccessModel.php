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
}