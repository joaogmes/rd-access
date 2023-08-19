<?php

require_once(app . '/dao/LogDao.php');

class LogModel
{

    private $table = "Log";
    private $dao;

    public function __construct()
    {
        $this->dao = new LogDao($this->table);
    }

}
