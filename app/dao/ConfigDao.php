<?php

require_once(app . '/core/Dao.php');

class ConfigDao extends Dao
{

    public function __construct($table)
    {
        parent::__construct($table);
    }

    public function getConfig()
    {
        return "x";
    }
}
