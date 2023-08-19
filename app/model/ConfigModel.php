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

    public function verifyTerminalSetup()
    {
        $verifyQuery = "SELECT * FROM Config";
        $configRegisters = $this->dao->list($verifyQuery);
        if ($configRegisters['total'] != 1) {
            $this->resetConfig();
            if (is_numeric($this->setNewConfig())) {
                return true;
            }
            return false;
        }
        return $configRegisters['results'][0];
    }

    public function resetConfig()
    {
        $resetQuery = $this->dao->execute("TRUNCATE Config");
    }

    private function setNewConfig()
    {
        $macAddress = trim(shell_exec("/sbin/ifconfig eth0 | grep -oE '([[:xdigit:]]{1,2}:){5}[[:xdigit:]]{1,2}'"));
        $configInsert = "INSERT INTO `RdAccessTerminal`.`Config` (`macAddress`) VALUES ('{$macAddress}')";
        return $this->dao->insert($configInsert);
    }
}
