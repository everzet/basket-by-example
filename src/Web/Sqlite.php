<?php

namespace Web;

use Doctrine\DBAL\DriverManager;
use PDO;

class Sqlite
{
    private $connection;

    public function __construct(string $db)
    {
        $this->connection = DriverManager::getConnection([
            'user' => 'root',
            'password' => null,
            'path' => $db,
            'driver' => 'pdo_sqlite',
        ]);
    }

    public function query(string $query, array $params = array()) : array
    {
        return $this->connection->executeQuery($query, $params)->fetchAll(PDO::FETCH_COLUMN);
    }

    public function update(string $query, array $params = array())
    {
        $this->connection->executeUpdate($query, $params);
    }
}
