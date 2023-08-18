<?php

require_once(app . '/core/Dao.php');

class AccessDao extends Dao
{

    public function __construct($table)
    {
        parent::__construct($table);
    }

}
