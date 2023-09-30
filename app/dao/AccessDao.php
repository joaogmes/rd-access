<?php

namespace Dao\Access;

use Dao\Dao;

class AccessDao extends Dao
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
