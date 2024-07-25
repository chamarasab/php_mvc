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

$router->addRoute('POST', '/inquiry', 'InquiryController', 'create');
$router->addRoute('GET', '/inquiry/{id}', 'InquiryController', 'read');
$router->addRoute('GET', '/inquiries', 'InquiryController', 'readAll');
$router->addRoute('PUT', '/inquiry/{id}', 'InquiryController', 'update');
$router->addRoute('DELETE', '/inquiry/{id}', 'InquiryController', 'delete');
$router->addRoute('POST', '/inquiry/search', 'InquiryController', 'search');

// New routes for approving inquiries and fetching approved inquiries
$router->addRoute('POST', '/inquiry/{id}/approve', 'InquiryController', 'approve');
$router->addRoute('GET', '/inquiries/approved', 'InquiryController', 'getApprovedInquiries');
$router->addRoute('GET', '/inquiries/unapproved', 'InquiryController', 'getUnapprovedInquiries');
