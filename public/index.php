<?php

error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
ini_set('display_errors', '0');

require '../vendor/autoload.php';
require '../src/config/config.php';
require '../src/core/Router.php';

use Core\Router;

set_exception_handler('handleException');

$router = new Router();

// Load the routes
require '../src/routes/web.php';

// Handle the request
$router->handleRequest($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

function handleException($e) {
    http_response_code(500);
    echo json_encode(['message' => 'Internal Server Error']);
}
