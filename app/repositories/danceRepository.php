<?php
require __DIR__ . '/repository.php';
require_once __DIR__ . ' /../models/dance.php';

class DanceRepository extends Repository
{
    public function getAllDanceEvents()
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM dance_events');
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Dance');
            $danceEvents = $stmt->fetchAll();

            return $danceEvents;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function addDanceEvent($danceEvent)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO dance_events (venue_id, date, start_time, end_time, session, tickets_available, price) VALUES (:venue_id, :date, :start_time, :end_time, :session, :tickets_available, :price)');
            $stmt->execute([
                ':venue_id' => $danceEvent->getVenueId(),
                ':date' => $danceEvent->getDate(),
                ':start_time' => $danceEvent->getStartTime(),
                ':end_time' => $danceEvent->getEndTime(),
                ':session' => $danceEvent->getSession(),
                ':tickets_available' => $danceEvent->getTicketsAvailable(),
                ':price' => $danceEvent->getPrice()
            ]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function updateDanceEvent($danceEvent)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE dance_events SET venue_id = :venue_id, date = :date, start_time = :start_time, end_time = :end_time, session = :session, tickets_available = :tickets_available, price = :price WHERE id = :id');
            $stmt->execute([
                ':id' => $danceEvent->getId(),
                ':venue_id' => $danceEvent->getVenueId(),
                ':date' => $danceEvent->getDate(),
                ':start_time' => $danceEvent->getStartTime(),
                ':end_time' => $danceEvent->getEndTime(),
                ':session' => $danceEvent->getSession(),
                ':tickets_available' => $danceEvent->getTicketsAvailable(),
                ':price' => $danceEvent->getPrice()
            ]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deleteDanceEvent($id)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM dance_events WHERE id = :id');
            $stmt->execute([':id' => $id]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getEventArtists($id)
    {
        try {
            $stmt = $this->connection->prepare('SELECT artists.id, artists.name
                                                FROM artists 
                                                INNER JOIN event_artists 
                                                ON artists.id = event_artists.artist_id 
                                                WHERE event_artists.event_id = :id'
            );

            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $eventArtists = $stmt->fetchAll();
            return $eventArtists;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}