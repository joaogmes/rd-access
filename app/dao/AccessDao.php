<?php

require_once(app . '/core/Dao.php');

class AccessDao extends Dao
{

    public function __construct($table)
    {
        parent::__construct($table);
    }

    public function simpleFilter($table, $field, $value){
        return $this->simpleSearch($table, $field, $value);
    }

}
