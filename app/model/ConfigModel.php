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
        while (true) {
            $verifyQuery = "SELECT * FROM Config";
            $configRegisters = $this->dao->list($verifyQuery);
            if ($configRegisters['total'] != 1) {
                $this->resetConfig();
                $this->setNewConfig();
                // if ($this->setNewConfig()) {
                //     return true;
                // }
                // return false;
            }
            return $configRegisters['results'][0];
        }
    }

    public function resetConfig()
    {
        $resetQuery = $this->dao->execute("TRUNCATE Config");
    }

    private function setNewConfig()
    {
        $macAddress = trim(shell_exec("/sbin/ifconfig eth0 | grep -oE '([[:xdigit:]]{1,2}:){5}[[:xdigit:]]{1,2}'"));
        $configInsert = "INSERT INTO `RdAccessTerminal`.`Config` (`macAddress`) VALUES ('{$macAddress}')";
        if (!is_numeric($this->dao->insert($configInsert))) {
            return false;
        }

        $authInsert = "INSERT INTO `RdAccessTerminal`.`Authorization` (`codePrefix`, `codeSuffix`, `rangeStart`, `rangeEnd`) VALUES ('123', '123', 1, 50)";
        if (!is_numeric($this->dao->insert($authInsert))) {
            return false;
        }

        return true;
    }
}
