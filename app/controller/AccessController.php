<?php

require_once(app . 'model/AccessModel.php');

class AccessController extends Controller
{
    private $model;

    public function __construct() {
        parent::__construct();
        $this->model = new AccessModel();
    }

    public function index()
    {
        $list = $this->model->list();
        $this->assign("accessList" , $list);
        $this->display('index.tpl');
    }

    public function searchByCode($code){
        return $this->model->get("code", $code);
    }

}
