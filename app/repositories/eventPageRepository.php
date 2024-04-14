<?php

require_once(__DIR__ . '/repository.php');
require_once(__DIR__ . '/../models/eventPage.php');

class EventPageRepository extends Repository
{
    public function getAllEvents()
    {
        $sql = "SELECT * FROM events_page";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $eventPages = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        $events = [];
        foreach ($eventPages as $eventData) {
            $event = new EventPage();
            $event->setId($eventData['id']);
            $event->setTitle($eventData['title']);
            $event->setSubTitle($eventData['sub_title']);
            $event->setDescription($eventData['description']);
            $event->setInformation($eventData['information']);
           // $event->setImage($eventData['event_image']);
            $events[] = $event;
        }
    
        return $events;
    }
    

    public function createEventPage(EventPage $eventPage)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO events_page (title, sub_title, description, information) VALUES (:title, :sub_title, :description, :information)');
            $stmt->execute([
                ':title' => $eventPage->getTitle(),
                ':sub_title' => $eventPage->getSubTitle(),
                ':description' => $eventPage->getDescription(),
                ':information' => $eventPage->getInformation()
            ]);

            return true;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
    public function updateEventPage(EventPage $eventPage)
    {
        try {
            $query = 'UPDATE events_page SET ';
            $params = [];

            if ($eventPage->getTitle()) {
                $query .= 'title = :title, ';
                $params[':title'] = $eventPage->getTitle();
            }

            if ($eventPage->getSubTitle()) {
                $query .= 'sub_title = :sub_title, ';
                $params[':sub_title'] = $eventPage->getSubTitle();
            }

            if ($eventPage->getDescription()) {
                $query .= 'description = :description, ';
                $params[':description'] = $eventPage->getDescription();
            }

            if ($eventPage->getInformation()) {
                $query .= 'information = :information, ';
                $params[':information'] = $eventPage->getInformation();
            }

            $query = rtrim($query, ', ');

            $query .= ' WHERE id = :id';
            $params[':id'] = $eventPage->getId();

            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);

            return true;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function deleteEventPage($eventId)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM events_page WHERE id = :id');
            $stmt->execute([':id' => $eventId]);

            return true;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }
    public function getEventPageById($eventId)
{
    $sql = "SELECT * FROM events_page WHERE id = :eventId";
    $statement = $this->connection->prepare($sql);
    $statement->bindParam(':eventId', $eventId, PDO::PARAM_INT);
    $statement->execute();
    $eventPageData = $statement->fetch(PDO::FETCH_ASSOC);

    if ($eventPageData) {
        $eventPage = new EventPage();
        $eventPage->setId($eventPageData['id']);
        $eventPage->setTitle($eventPageData['title']);
        $eventPage->setSubTitle($eventPageData['sub_title']);
        $eventPage->setDescription($eventPageData['description']);
        $eventPage->setInformation($eventPageData['information']);

        return $eventPage;
    } else {
        return null; 
    }
}
public function getAllEventPageTitles()
{
    $sql = "SELECT title FROM events_page WHERE id > 2";
    $statement = $this->connection->prepare($sql);
    $statement->execute();
    $eventPageTitles = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $eventPageTitles;
}

}