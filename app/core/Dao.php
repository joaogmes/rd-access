<?php

require_once(app  . '/settings/Settings.php');

class Dao extends Settings
{
    private $settings;
    private $database;

    public function __construct($table)
    {
        $this->settings = $this->getSettings();
        $this->database = $this->connect();
    }

    public function connect()
    {
        $host = $this->settings['database']['DB_HOST'];
        $dbName = $this->settings['database']['DB_NAME'];
        $username = $this->settings['database']['DB_USER'];
        $password = $this->settings['database']['DB_PASS'];
        try {
            $dsn = "mysql:host=$host;dbname=$dbName;charset=utf8mb4";
            $pdo = new PDO($dsn, $username, $password);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }


    public function list($query)
    {
        try {
            $data = $this->database->prepare("{$query}");
            $data->execute();
            $results = [];
            while ($info = $data->fetch(PDO::FETCH_ASSOC)) {
                $results[] = (object) $info;
            }

            return ["total" => $data->rowCount(), "results" => $results];
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function insert($query)
    {
        try {
            $data = $this->database->prepare("{$query}");
            $data->execute();
            return $this->database->lastInsertId();
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function execute($query)
    {
        try {
            $data = $this->database->prepare("{$query}");
            $data->execute();
            return true;
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }

    public function simpleSearch($table, $field, $param)
    {
        try {
            $data = $this->database->prepare("SELECT * FROM {$table} WHERE {$table}.`{$field}` = '{$param}'");
            $data->execute();
            if ($data->rowCount() > 0) {
                while ($info = $data->fetch(PDO::FETCH_ASSOC)) {
                    $entity = (object) $info;
                    return $entity;
                }
            }
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    }
}
