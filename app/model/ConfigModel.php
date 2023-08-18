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

    public function verifyTerminalSetup(){
        $verifyQuery = "SELECT * FROM Config";
        $configRegisters = $this->dao->list($verifyQuery);
        if($configRegisters['total'] != 1){
            $this->resetConfig();
            return false;
        }
        return $configRegisters['results'][0];
    }

    public function resetConfig(){
        $resetQuery = $this->dao->execute("TRUNCATE Config");
    }

}
