<?php

class Db
{
    private PDO $connection;
    private PDOStatement $stmt;

    public function __construct(array $db_config)
    {
        $dsn = "mysql:host={$db_config['host']};dbname={$db_config['dbname']}";
        try {
            $this->connection = new PDO($dsn, $db_config['username'], $db_config['password']);
            return $this;
        } catch (PDOException $e) {
            echo "DB Error {$e->getMessage()}";
        }
    }

    public function query($query, $params = []) {
        try {
            $this->stmt = $this->connection->prepare($query);
            $this->stmt->execute($params);
        } catch (PDOException $e) {
            return false;
        }

        return $this->stmt;
    }
}