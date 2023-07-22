<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app->get('/', function (Request $request, Response $response) {
    include_once(app . 'controller/Test.php');
    $test = new Test();
    $testVal = $test->index('x');
    // $response->getBody()->write($testVal);
    return $response;
});