<?php

namespace Model\Authorization;

use Dao\Authorization\AuthorizationDao;

class AuthorizationModel
{

    private $table = "Authorization";
    private $dao;

    public function __construct()
    {
        $this->dao = new AuthorizationDao($this->table);
    }

    public function listAuthorization(){
        $sql = "SELECT * FROM Authorization";
        $auths = $this->dao->list($sql);

        return  $auths;
    }

    public function createAuthorization($data)
    {
        $ticket = isset($data['ticket']) && $data['ticket'] !== '' ? $data['ticket'] : '';
        $type = isset($data['type']) && $data['type'] !== '' ? $data['type'] : 'allow';
        $codeCore = isset($data['codecore']) && $data['codecore'] !== '' ? $data['codecore'] : '';
        $codePrefix = isset($data['codeprefix']) && $data['codeprefix'] !== '' ? $data['codeprefix'] : '';
        $codeSuffix = isset($data['codesuffix']) && $data['codesuffix'] !== '' ? $data['codesuffix'] : '';
        $authType = isset($data['authtype']) && $data['authtype'] !== '' ? $data['authtype'] : 'normal';
        $rangeStart = isset($data['rangestart']) && $data['rangestart'] !== '' ? $data['rangestart'] : 1;
        $rangeEnd = isset($data['rangeend']) && $data['rangeend'] !== '' ? $data['rangeend'] : 1;
        $creationDate = isset($data['creationdate']) && $data['creationdate'] !== '' ? $data['creationdate'] : date('Y-m-d H:i:s');
        $updateDate = isset($data['updatedate']) && $data['updatedate'] !== '' ? $data['updatedate'] : date('Y-m-d H:i:s');
        
        $sql = "INSERT INTO Authorization (ticket, `type`, codeCore, codePrefix, codeSuffix, authType, rangeStart, rangeEnd, creationDate, updateDate) 
                VALUES ('{$ticket}', '{$type}', '{$codeCore}', '{$codePrefix}', '{$codeSuffix}', '{$authType}', '{$rangeStart}', '{$rangeEnd}', '{$creationDate}', '{$updateDate}')";
        // var_dump($sql);
        // exit();
        $insertAuthorization = $this->dao->insert($sql);
    
        if (is_numeric($insertAuthorization)) {
            return true;
        }
    
        return false;
    }
    public function verifyAuthentication($code)
    {
        $sql = "SELECT * FROM Authorization WHERE ('{$code}' LIKE CONCAT(codePrefix COLLATE utf8mb4_general_ci, '%', codeSuffix COLLATE utf8mb4_general_ci)) OR ('{$code}' = codeCore COLLATE utf8mb4_general_ci AND authType = 'master' )";
        $auths = $this->dao->list($sql);
        if ($auths['total'] > 0) {

            $verifiedAuth = [];
            foreach ($auths['results'] as $authorization) {

                $prefix = $authorization->codePrefix;
                $suffix = $authorization->codeSuffix;

                $core = str_replace($prefix, '', $code);
                $core = intval(str_replace($suffix, '', $core));

                if ($authorization->rangeEnd == null && $authorization->rangeStart == null) {
                    return $authorization;
                }

                if ($authorization->rangeEnd > 0) {
                    $maxRangeLength = strlen((string) $authorization->rangeEnd);
                    $formatedCore = str_pad($core, $maxRangeLength, '0', STR_PAD_LEFT);
                }

                if (
                    $authorization->rangeStart >= 0 && $authorization->rangeEnd > $authorization->rangeStart
                    && ($core >= $authorization->rangeStart && $core <= $authorization->rangeEnd)
                ) {
                    return $authorization;
                } else if (
                    $authorization->rangeStart > 0 && ($authorization->rangeEnd == null || $authorization->rangeEnd == "")
                    && ($core > $authorization->rangeStart)
                ) {
                    return $authorization;
                } else if (
                    $authorization->rangeEnd > 0 && ($authorization->rangeStart == null || $authorization->rangeStart == "")
                    && ($core > 0 && $core < $authorization->rangeEnd)
                ) {
                    return $authorization;
                }
            }
        }
        return false;
    }

    public function searchAuthorizationByCode($code)
    {
        return $this->dao->simpleFilter("Authorization", "code", $code);
    }

    public function searchAccecssByCodeOnGlobalTable($code)
    {
        $sql = "SELECT * FROM GlobalAuthorization WHERE code = '{$code}'";
        $globalSearch = $this->dao->list($sql);
        if ($globalSearch['total'] > 0) {
            return ["date" => $globalSearch["creationDate"], "id" => "accessId"];
        }
        return false;
    }

    public function insertAuthorization($code, $authorization)
    {
        $macAddress = trim(shell_exec("/sbin/ifconfig eth0 | grep -oE '([[:xdigit:]]{1,2}:){5}[[:xdigit:]]{1,2}'"));
        $sql = "INSERT INTO Authorization (macAddress, authorization, code) VALUES ('{$macAddress}', '{$authorization->id}', '{$code}')";
        $insertAuthorization = $this->dao->insert($sql);
        if (is_numeric($insertAuthorization)) {
            return $authorization;
        }
        return false;
    }
}
