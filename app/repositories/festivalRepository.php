<?php
require_once(__DIR__ . '/repository.php');
require_once(__DIR__ . '/../models/image.php');
require_once(__DIR__ . '/../models/eventOverview.php');
require_once(__DIR__ . '/../models/eventPage.php');
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
                $event->setButton($eventData['button_path']);
                
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

public function updateEventTitle($eventId, $title)
{
    try {
        $stmt = $this->connection->prepare('UPDATE events_page SET title = :title WHERE id = :eventId');
        $stmt->execute([
            ':title' => $title,
            ':eventId' => $eventId
        ]);

        if ($stmt->rowCount() > 0) {
            return true; 
        } else {
            return false; 
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false; 
    }
}
public function updateEventSubTitle($eventId, $subTitle)
{
    try {
        $stmt = $this->connection->prepare('UPDATE events_page SET sub_title = :sub_title WHERE id = :eventId');
        $stmt->execute([
            ':sub_title' => $subTitle,
            ':eventId' => $eventId
        ]);

        if ($stmt->rowCount() > 0) {
            return true; 
        } else {
            return false; 
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false; 
    }
}
public function updateEventDescription($eventId, $description)
{
    try {
        $stmt = $this->connection->prepare('UPDATE events_page SET description = :description WHERE id = :eventId');
        $stmt->execute([
            ':description' => $description,
            ':eventId' => $eventId
        ]);

        if ($stmt->rowCount() > 0) {
            return true; 
        } else {
            return false; 
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false; 
    }
}
public function updateEventTitleOverview($eventId, $title)
{
    try {
        $stmt = $this->connection->prepare('UPDATE events SET title = :title WHERE id = :eventId');
        $stmt->execute([
            ':title' => $title,
            ':eventId' => $eventId
        ]);

        if ($stmt->rowCount() > 0) {
            return true; 
        } else {
            return false; 
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false; 
    }
}

public function updateEventDescriptionOverview($eventId, $description)
{
    try {
        $stmt = $this->connection->prepare('UPDATE events SET description = :description WHERE id = :eventId');
        $stmt->execute([
            ':description' => $description,
            ':eventId' => $eventId
        ]);

        if ($stmt->rowCount() > 0) {
            return true; 
        } else {
            return false; 
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false; 
    }
}

public function updateEventSchedule($eventId, $schedule)
{
    try {
        $stmt = $this->connection->prepare('UPDATE events SET schedule = :schedule WHERE id = :eventId');
        $stmt->execute([
            ':schedule' => $schedule,
            ':eventId' => $eventId
        ]);

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false; 
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false; 
    }
}

public function updateEventLocation($eventId, $location)
{
    try {
        $stmt = $this->connection->prepare('UPDATE events SET locations = :locations WHERE id = :eventId');
        $stmt->execute([
            ':locations' => $location,
            ':eventId' => $eventId
        ]);

        if ($stmt->rowCount() > 0) {
            return true; 
        } else {
            return false; 
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false; 
    }
}
}


?>