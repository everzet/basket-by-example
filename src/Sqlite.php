<?php

use Doctrine\DBAL\Driver\Statement;
use Doctrine\DBAL\DriverManager;

class Sqlite
{
    private $connection;

    public function __construct()
    {
        $this->connection = DriverManager::getConnection([
            'user'     => 'root',
            'password' => null,
            'path'     => __DIR__ . '/../db.sqlite',
            'driver'   => 'pdo_sqlite',
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
