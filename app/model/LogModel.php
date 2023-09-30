<?php

namespace Model\Log;

use Dao\LogDao\LogDao;

class LogModel
{

    private $table = "Log";
    private $dao;

    public function __construct()
    {
        $this->dao = new LogDao($this->table);
    }
}
