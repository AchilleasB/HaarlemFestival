<?php
require_once(__DIR__ . '/../models/eventPage.php');

class EventPageRepository extends Repository
{ 

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
        $stmt = $this->connection->prepare('UPDATE events_page SET title = :title, sub_title = :sub_title, description = :description, information = :information WHERE id = :id');
        $stmt->execute([
            ':id' => $eventPage->getId(),
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
}
