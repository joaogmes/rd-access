<?php

require_once(app . '/dao/ConfigDao.php');

class ConfigModel
{

    private $table = "Config";
    private $dao;

    public function __construct()
    {
        $this->dao = new ConfigDao($this->table);
    }

}
