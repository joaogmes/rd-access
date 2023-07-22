<?php

require_once(app  . '/config/Config.php');

class Model
{
    private $table;
    public function __construct()
    {
    }
    public function connect()
    {
        global $settings;

        $host = $settings['database']['DB_HOST'];
        $dbName = $settings['database']['DB_NAME'];
        $username = $settings['database']['DB_USER'];
        $password = $settings['database']['DB_PASS'];

        try {
            $dsn = "mysql:host=$host;dbname=$dbName;charset=utf8mb4";
            $pdo = new PDO($dsn, $username, $password);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
