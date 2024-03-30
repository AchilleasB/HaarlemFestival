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
}
