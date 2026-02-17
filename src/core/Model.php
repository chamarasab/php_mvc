<?php

namespace Core;

use PDO;
use PDOException;

class Model
{
    protected $db;

    public function __construct()
    {
        $config = require __DIR__ . '/../config/config.php';
        try {
            $this->db = new PDO(
                'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'],
                $config['db']['user'],
                $config['db']['pass'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            error_log($e->getMessage());
            throw new \RuntimeException('Database connection failed.');
        }
    }
}
?>
