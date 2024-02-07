<?php

class Repository
{
    protected $connection;

    function __construct()
    {
        require __DIR__ . '/../config/dbconfig.php';

        try {
            $this->connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}