<?php
namespace Controller\Config;

use Controller\Controller;
use Model\Config\ConfigModel as Model;

class ConfigController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new Model();
    }

    public function checkSetup()
    {
        return $this->model->verifyTerminalSetup();
    }
}
