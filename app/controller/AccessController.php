<?php
namespace Controller\Access;

use Controller\Controller;
use Model\Access\AccessModel;

class AccessController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new AccessModel();
    }

    public function index()
    {
        // $list = $this->model->list();
        // $this->assign("accessList", $list);
        $this->display('index.tpl');
    }

    public function searchAccessByCode($code)
    {
        return $this->model->searchAccessByCode($code);
    }

    public function globalSearchAccessByCode($code)
    {
        return $this->model->searchAccecssByCodeOnGlobalTable($code);
    }

    public function checkAuth($code)
    {
        return $this->model->verifyAuthentication($code);
    }

    public function registerAccess($code, $authorization)
    {
        return $this->model->insertAccess($code, $authorization);
    }
}
