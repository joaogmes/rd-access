<?php

require_once(ROOT . '/app/controller' . "Controller.php");
require_once(MODEL_PATH . "LoginModel.php");
class LoginController extends Controller
{
    public function index()
    {
        $this->checkSession();
        $this->display("login.tpl");
        return true;
    }

    public function login($login, $password){
        $model = new LoginModel();
        return $model->authenticate($login, $password);
    }

    private function checkSession(){
        $session = !isset($_SESSION) ? session_start() : true;
        $user = $_SESSION['user'] ?? false;
        if($user){
            Header('location: ./manager');
            exit;
        }
        return true;
    }
}

