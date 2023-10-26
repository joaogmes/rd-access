<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

// $app->post('/test/{id}', function (Request $request, Response $response, array $args) {
//     var_dump($args);
//     print_r($request->getParsedBody());
//     // print_r($response);
//     die('teste');
// });

$app->post('/setup/{event}', function (Request $request, Response $response, array $args) {
    var_dump($args);
    print_r($request->getParsedBody());
    // print_r($response);
    die('teste');
});
