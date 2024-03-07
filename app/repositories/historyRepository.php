<?php
require_once(__DIR__ . '/Repository.php');
require_once(__DIR__ . '/../models/locations.php');

class HistoryRepository extends Repository
{
    function getAllLocations()
    {
        try {
            $sql = "SELECT * FROM locations";

            $statement = $this->connection->prepare($sql);
            $statement->execute();

            $locations = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $locations;
        } catch (PDOException $e) {

            echo "Error: " . $e->getMessage();
            return [];
        }
    }

   

}