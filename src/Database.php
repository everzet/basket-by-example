<?php

use Doctrine\DBAL\Driver\Statement;
use Doctrine\DBAL\DriverManager;

class Database
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

    public function query(string $query, array $params = array()) : Statement
    {
        return $this->connection->executeQuery($query, $params);
    }

    public function update(string $query, array $params = array())
    {
        $this->connection->executeUpdate($query, $params);
    }
}
