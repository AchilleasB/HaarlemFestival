<?php
require_once(__DIR__ . '/Repository.php');
require_once(__DIR__ . '/../models/locations.php');

class LocationRepository extends Repository
{
    // Method to get all locations
    public function getAllLocations()
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


    public function getLocationById($id)
    {
        try {

            $sql = "SELECT * FROM locations WHERE id = :id";

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':id', $id);
            $statement->execute();

            $location = $statement->fetch(PDO::FETCH_ASSOC);

            return $location;
        } catch (PDOException $e) {

            echo "Error: " . $e->getMessage();
            return null;
        }
    }
    
}