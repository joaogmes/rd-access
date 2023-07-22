<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// $router->addRoute('POST', '/login', function () {
//     header('Content-Type: application/json');
//     require_once(ROOT . '/app/controller' . "LoginController.php");
//     $loginController = new LoginController();

//     $jsonData = file_get_contents('php://input');
//     $data = json_decode($jsonData);

//     $login = isset($data->login) ? $data->login : false;
//     $password = isset($data->password) ? $data->password : false;

//     if (!$login || !$password) {
//         echo json_encode(["error" => "missing parameters"]);
//     } else {
//         echo json_encode($loginController->login($login, $password));
//     }
//     return;
// });


// $router->addRoute('POST', '/api/data', function () {
//     $data = ['key' => 'value'];
//     return json_encode($data);
// });