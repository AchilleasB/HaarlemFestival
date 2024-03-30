<?php
require_once(__DIR__ . '/repository.php');
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
    public function getAllLocationsWithImages()
    {
        try {
            $sql = "SELECT l.*, i.image 
            FROM locations l
            LEFT JOIN images i ON l.images = i.id";
    

            $statement = $this->connection->prepare($sql);
            $statement->execute();
    
            $locations = [];
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $location = new Location();
                $location->setId($row['id']);
                $location->setLocationName($row['location_name']);
                $location->setAddress($row['address']);
                $location->setDescription($row['description']);
                $location->setLinks($row['links']);
                $location->setImage($row['image']);
    
                $locations[] = $location;
            }
    
            return $locations;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
    public function getEventDetails()
    {
        try {
            $sql = "SELECT * FROM events_page WHERE id = 1";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $eventDetails = $statement->fetch(PDO::FETCH_ASSOC);

            $event = new EventPage();
            $event->setId($eventDetails['id']);
            $event->setTitle($eventDetails['title']);
            $event->setSubTitle($eventDetails['sub_title']);
            $event->setDescription($eventDetails['description']);
            $event->setInformation($eventDetails['information']);

            return $event;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }
}

   

