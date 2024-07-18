<?php

require '../vendor/autoload.php';
require '../src/config/config.php';
require '../src/core/Router.php';

use Core\Router;

$router = new Router();

// Load the routes
require '../src/routes/web.php';

// Handle the request
$router->handleRequest($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
?>
