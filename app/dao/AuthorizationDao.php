<?php

namespace Dao\Authorization;

use Dao\Dao;

class AuthorizationDao extends Dao
{

    public function __construct($table)
    {
        parent::__construct($table);
    }

    public function simpleFilter($table, $field, $value)
    {
        return $this->simpleSearch($table, $field, $value);
    }

}
