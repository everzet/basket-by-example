<?php

namespace Web;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\DriverManager;
use PDO;

class Database
{
    private $connection;

    public function __construct(string $dbFile)
    {
        $this->connection = DriverManager::getConnection([
            'user' => 'root',
            'password' => null,
            'path' => $dbFile,
            'driver' => 'pdo_sqlite',
        ]);
    }

    public function query(string $query, array $params = array()) : Collection
    {
        return new ArrayCollection($this->connection->executeQuery($query, $params)->fetchAll(PDO::FETCH_COLUMN));
    }

    public function update(string $query, array $params = array())
    {
        $this->connection->executeUpdate($query, $params);
    }
}
