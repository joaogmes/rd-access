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

    public function getEntity($key, $value)
    {
        // die("SELECT * FROM {$this->table} WHERE {$this->table}.`{$key}` = '{$value}'");
        $data = $this->database->prepare("SELECT * FROM {$this->table} WHERE {$this->table}.`{$key}` = '{$value}'");
        $data->execute();
        if ($data->rowCount() > 0) {
            while ($info = $data->fetch(PDO::FETCH_ASSOC)) {
                $entity = (object) $info;
                return $entity;
            }
        }
        return false;
    }

    public function inserEntity($entity){
        $assoc = get_object_vars ($entity);
        
        $queryFields = "(";
        $queryValues = "("; 
        
        foreach($assoc as $field => $value){
            $queryFields .= '`' . $field . '` ,';
            $queryValues .=  '"' . $field . '" ,';
        }

        substr($queryFields, 0, -2);
        substr($queryValues, 0, -2);

        $queryFields .= ")";
        $queryValues .= ")";

        print_r($queryFields);
        print_r($queryValues);
        die;
    }
}
