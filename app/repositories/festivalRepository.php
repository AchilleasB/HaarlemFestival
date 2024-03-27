<?php
require_once(__DIR__ . '/repository.php');
require_once(__DIR__ . '/../models/image.php');
require_once(__DIR__ . '/../models/eventOverview.php');
class FestivalRepository extends Repository
{

    public function getAllEvents()
    {
        try {
            $sql = "SELECT e.*, i.image AS event_image 
                    FROM events e
                    LEFT JOIN images i ON e.event_image = i.id";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $eventsData = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            $events = [];
            foreach ($eventsData as $eventData) {
                $event = new EventOverview();
                $event->setId($eventData['id']);
                $event->setTitle($eventData['title']);
                $event->setSubTitle($eventData['sub_title']);
                $event->setDescription($eventData['description']);
                $event->setLocations($eventData['locations']);
                $event->setSchedule($eventData['schedule']);
                $event->setImage($eventData['event_image']);
                
                $events[] = $event;
            }
    
            return $events;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
    public function getEventDetails()
    {
        try {
            $sql = "SELECT * FROM events_page WHERE id = 2";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $eventDetails = $statement->fetch(PDO::FETCH_ASSOC);

            $event = new Event();
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


?>