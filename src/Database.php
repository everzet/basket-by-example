<?php

class Database
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    private $connection;

    public function __construct()
    {
        $this->connection = \Doctrine\DBAL\DriverManager::getConnection([
            'user'     => 'root',
            'password' => null,
            'path'     => __DIR__ . '/../db.sqlite',
            'driver'   => 'pdo_sqlite',
        ]);
    }

    public function query($query, array $params = array())
    {
        return $this->connection->executeQuery($query, $params);
    }

    public function update($query, array $params = array())
    {
        $this->connection->executeUpdate($query, $params);
    }
}
