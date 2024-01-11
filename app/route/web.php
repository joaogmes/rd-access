<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
// use PSpell\Config;

use Controller\Config\ConfigController as Config;
use Controller\Controller;
use Controller\Access\AccessController;

$app->get('/', function (Request $request, Response $response) {

    $access = new AccessController();
    $access->index();
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
