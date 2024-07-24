<?php
/*
return [
    'db' => [
        'host' => 'localhost',
        'dbname' => 'mvc',
        'user' => 'chamara',
        'pass' => '6526560'
    ],
    'log_file' => __DIR__ . '/../../logs/app.log'
];
*/

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

return [
    'db' => [
        'host' => $_ENV['DB_HOST'],
        'dbname' => $_ENV['DB_NAME'],
        'user' => $_ENV['DB_USER'],
        'pass' => $_ENV['DB_PASS']
    ],
    'log_file' => __DIR__ . '/../../logs/app.log'
];
