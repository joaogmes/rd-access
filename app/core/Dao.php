<?php

require_once(app  . '/config/Config.php');

class Dao extends Config
{
    private $settings;
    private $table;
    private $entity;
    private $database;

    public function __construct($table)
    {
        $this->table = $table;
        $this->settings = $this->getSettings();
        $this->database = $this->connect();
        $this->entity = $this->createEntity();
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

    private function createEntity()
    {
        $entity = new stdClass();
        foreach ($this->database->query("DESC {$this->table};") as $row) {
            $entity->{$row['Field']} = null;
        }
        return $entity;
    }

    public function listEntities()
    {
        $entities = [];
        $data = $this->database->prepare("SELECT * FROM {$this->table}");
        $data->execute();
        if ($data->rowCount() > 0) {
            while ($info = $data->fetch(PDO::FETCH_ASSOC)) {
                $entities[] = (object) $info;
            }
        }
        return ["total" => $data->rowCount(), "results" => $entities];
    }

    public function inserEntity($entity){

    }
}
