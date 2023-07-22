<?php

require_once(app . 'model/AccessModel.php');

class AccessController extends Controller
{
    private $table = "Access";
    private $model;

    public function __construct() {
        parent::__construct();
        $this->model = new AccessModel($this->table);
    }

    public function index()
    {
        $list = $this->model->list();
        $this->assign("accessList" , $list);
        $this->display('index.tpl');
    }

}
