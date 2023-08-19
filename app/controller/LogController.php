<?php

require_once(app . 'model/LogModel.php');

class LogController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new LogModel();
    }

    public function registerAccess($code, $authorization)
    {
        return $this->model->insertAccess($code, $authorization);
    }
}
