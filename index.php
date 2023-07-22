<?php

define("root", __DIR__ . '/');
define("app", root . '/app/');

require root . '/vendor/autoload.php';
require app . 'autoload.php';

use Slim\Factory\AppFactory;

$app = AppFactory::create();

include_once(app . 'route/web.php');
include_once(app . 'route/api.php');

$app->run();
