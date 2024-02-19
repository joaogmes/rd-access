<?php
namespace Controller\Authorization;

use Controller\Controller;
use Model\Authorization\AuthorizationModel;

class AuthorizationController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new AuthorizationModel();
    }

    public function index()
    {
         $list = $this->model->listAuthorization();
        //  var_dump($list);
        //  exit();
         $this->assign("accessList", $list); // joga variavel no template*
        $this->display('index.tpl');


    }
    public function create($data)
    {
         $create = $this->model->createAuthorization($data);
        //  var_dump($list);
        //  exit();
        if($create){
           return 'Cadastro realizado';
        }else{
           return 'Ocorreu um erro';
        }
      

    }

    public function searchAuthorizationByCode($code)
    {
        return $this->model->searchAuthorizationByCode($code);
    }

    public function globalSearchAuthorizationByCode($code)
    {
        return $this->model->searchAccecssByCodeOnGlobalTable($code);
    }

    public function checkAuth($code)
    {
        return $this->model->verifyAuthentication($code);
    }

    public function registerAuthorization($code, $authorization)
    {
        return $this->model->insertAuthorization($code, $authorization);
    }
}
