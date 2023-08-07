<?php

require_once(app . 'model/AccessModel.php');

class AccessController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new AccessModel();
    }

    public function index()
    {
        $list = $this->model->list();
        $this->assign("accessList", $list);
        $this->display('index.tpl');
    }

    public function searchByCode($code)
    {
        return $this->model->get("code", $code);
    }

    public function globalSearchByCode($code)
    {
        $sql = "SELECT * FROM GlobalAccess WHERE code = '{$code}'";
        $globalSearch = $this->model->runQuery($sql);
        if ($globalSearch['total'] > 0) {
            return ["date" => $globalSearch["creationDate"], "id" => "accessId"];
        }
        return false;
    }

    public function checkAuth($code)
    {
        $sql = "SELECT * FROM Authorization WHERE '{$code}' LIKE CONCAT(codePrefix, '%', codeSuffix) OR '{$code}' = CONCAT(codePrefix, codeCore, codeSuffix) ";
        $auths = $this->model->runQuery($sql);
        if ($auths['total'] > 0) {
            return $auths['results'][0];
        }
        return false;
    }

    public function registerAccess($code, $authorization)
    {
        $macAddress = trim(shell_exec("/sbin/ifconfig eth0 | grep -oE '([[:xdigit:]]{1,2}:){5}[[:xdigit:]]{1,2}'"));
        $sql = "INSERT INTO Access (macAddress, authorization, code) VALUES ('{$macAddress}', '{$authorization->id}', '{$code}')";
        $insertAccess = $this->model->runQueryInsert($sql);
        if (is_numeric($insertAccess)) {
            return true;
        }
        return false;
    }
}
