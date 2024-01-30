<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
// use PSpell\Config;

use Controller\Config\ConfigController as Config;
use Controller\Controller;
use Controller\Access\AccessController;
use Controller\Authorization\AuthorizationController;

$app->get('/', function (Request $request, Response $response) {
    
    $access = new AuthorizationController();
  
    $access->index();
    // $response->getBody()->write($testVal);
    return $response;
});
$app->get('/authorization', function (Request $request, Response $response) {

    $access = new AuthorizationController();
    $access->index();
    // $model = new Model("Access");
    // $response->getBody()->write($testVal);
    return $response;
});
$app->get('/authorization/create', function (Request $request, Response $response) {

    $access = new AuthorizationController();
    $access->display('authorization-create.tpl');
    // $response->getBody()->write($testVal);
    return $response;
});

$app->get('/access/{id}', function (Request $request, Response $response, array $args) {
    $configController = new Config();
    var_dump($args);
    die('teste');
});

$app->get('/search/{field}/{value}', function (Request $request, Response $response, array $args) {
    // $model = new Model("Access");
    $response->getBody()->write("isso é um teste");
    return $response;
});
