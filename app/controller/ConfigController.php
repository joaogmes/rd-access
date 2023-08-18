<?php

require_once(app . 'model/ConfigModel.php');

class ConfigController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ConfigModel();
    }

    public function index()
    {
        $list = $this->model->list();
        $this->assign("accessList", $list);
        $this->display('index.tpl');
    }

    public function getx($code)
    {
        return $this->model->get("code", $code);
    }
}
