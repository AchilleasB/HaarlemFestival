<?php
require_once(__DIR__ . '/repository.php');
require_once(__DIR__ . '/../models/locations.php');

class LocationRepository extends Repository
{
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
    
    public function getLocationImages(int $id): array|null
    {
        try {
            $stmt = $this->connection->prepare("SELECT i.id, i.image
                FROM images i
                INNER JOIN locations as li ON i.id = li.id
                WHERE li.id = :id
                AND (image LIKE '%detail%' OR image LIKE '%-primary%' OR image LIKE '%-secondary%')
                AND (image LIKE '%.png' OR image LIKE '%.jpg' OR image LIKE '%.jpeg')
                GROUP BY i.image_id
                ORDER BY i.image DESC
            ");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Image');
            $images = $stmt->fetchAll();
            return !empty($images) ? $images : null;
        } catch (PDOException $e) {
            echo "Error getting Locationimages: " . $e->getMessage();
            return null;
        }
    }
    
    public function createLocation($location)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO locations (location_name, address, description, links) VALUES (:location_name, :address, :description, :links)');
            $stmt->execute([
                ':location_name' => $location->getLocationName(),
                ':address' => $location->getAddress(),
                ':description' => $location->getDescription(),
                ':links' => $location->getLinks()
            ]);
            return true;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function updateLocation($location)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE locations SET location_name = :location_name, address = :address, description = :description, links = :links WHERE id = :id');
            $stmt->execute([
                ':id' => $location->getId(),
                ':location_name' => $location->getLocationName(),
                ':address' => $location->getAddress(),
                ':description' => $location->getDescription(),
                ':links' => $location->getLinks()
            ]);
            return true;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function deleteLocation($locationId)
    {
        try {
            $sql = "DELETE FROM locations WHERE id = :id";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(':id', $locationId);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
