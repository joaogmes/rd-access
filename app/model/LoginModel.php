<?php
require_once(MODEL_PATH . "Model.php");
class LoginModel extends Model
{
    private $pdo;

    public function __construct()
    {
        $model = new Model();
        $this->pdo = $model->connect();
    }

    public function authenticate($login, $password)
    {
        if ($this->getUser($login, $password)) {
            return true;
        }

        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE login = :login AND senha = :password");
        $stmt->execute(['login' => $login, "password" => $password]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $session = !isset($_SESSION) ? session_start() : true;
            $_SESSION['user'] = base64_encode($login . $password);
            return true;
        }

        return false;
    }

    public function getUser($login, $password)
    {
        $session = !isset($_SESSION) ? session_start() : true;
        $user = $_SESSION['user'] ?? false;
        if ($user) {
            if ($user == base64_encode($login . $password)) {
                return true;
            }
            return false;
        }
        return $user;
    }
}