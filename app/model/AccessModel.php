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

    public function verifyAuthentication($code)
    {
        $sql = "SELECT * FROM Authorization WHERE '{$code}' LIKE CONCAT(codePrefix, '%', codeSuffix) OR '{$code}' = CONCAT(codePrefix, codeCore, codeSuffix) ";
        $auths = $this->dao->list($sql);
        if ($auths['total'] > 0) {
            return $auths['results'][0];
        }
        return false;
    }

    public function searchAccessByCode($code)
    {
        return $this->dao->simpleFilter("Access", "code", $code);
    }

    public function searchAccecssByCodeOnGlobalTable($code)
    {
        $sql = "SELECT * FROM GlobalAccess WHERE code = '{$code}'";
        $globalSearch = $this->dao->list($sql);
        if ($globalSearch['total'] > 0) {
            return ["date" => $globalSearch["creationDate"], "id" => "accessId"];
        }
        return false;
    }

    public function insertAccess($code, $authorization)
    {
        $macAddress = trim(shell_exec("/sbin/ifconfig eth0 | grep -oE '([[:xdigit:]]{1,2}:){5}[[:xdigit:]]{1,2}'"));
        $sql = "INSERT INTO Access (macAddress, authorization, code) VALUES ('{$macAddress}', '{$authorization->id}', '{$code}')";
        $insertAccess = $this->dao->insert($sql);
        if (is_numeric($insertAccess)) {
            return true;
        }
        return false;
    }
}
