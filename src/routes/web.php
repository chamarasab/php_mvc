<?php

use Core\Router;

$router->addRoute('POST', '/register', 'UserController', 'register');
$router->addRoute('POST', '/login', 'UserController', 'login');
$router->addRoute('GET', '/user/{id}', 'UserController', 'getUserById');
$router->addRoute('GET', '/users', 'UserController', 'listUsers');
$router->addRoute('PUT', '/user/{id}', 'UserController', 'updateUser');
$router->addRoute('DELETE', '/user/{id}', 'UserController', 'deleteUser');
?>
