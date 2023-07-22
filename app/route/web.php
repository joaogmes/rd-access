<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/', function (Request $request, Response $response) {
    include_once(app . 'controller/AccessController.php');
    $access = new AccessController();
    $access->index();
    // $model = new Model("Access");
    // $response->getBody()->write($testVal);
    return $response;
});