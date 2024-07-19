<?php

use Core\Router;

$router->addRoute('POST', '/register', 'UserController', 'register');
$router->addRoute('POST', '/login', 'UserController', 'login');
$router->addRoute('GET', '/user/{id}', 'UserController', 'getUserById');
$router->addRoute('GET', '/users', 'UserController', 'listUsers');
$router->addRoute('PUT', '/user/{id}', 'UserController', 'updateUser');
$router->addRoute('DELETE', '/user/{id}', 'UserController', 'deleteUser');
$router->addRoute('POST', '/request-password-reset', 'UserController', 'requestPasswordReset');
$router->addRoute('POST', '/reset-password', 'UserController', 'resetPassword');
$router->addRoute('GET', '/reset-password', 'UserController', 'showResetPasswordForm');
?>
