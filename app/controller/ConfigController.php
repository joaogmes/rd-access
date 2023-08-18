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

    public function checkSetup()
    {
        return $this->model->verifyTerminalSetup();
    }
}
