<?php
require_once(__DIR__ . '/repository.php');
require_once(__DIR__ . '/../models/image.php');
class FestivalRepository extends Repository
{

    public function getAllEvents()
    {
        try {
            $sql = "SELECT * FROM events";
            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $events = $statement->fetchAll(PDO::FETCH_ASSOC);

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