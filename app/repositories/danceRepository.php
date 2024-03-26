<?php
require __DIR__ . '/repository.php';
require_once __DIR__ . ' /../models/dance.php';
require_once __DIR__ . ' /../models/venue.php';

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
            $stmt = $this->connection->prepare('INSERT INTO dance_events (venue_id, date, start_time, end_time, session, tickets_available, price, type) VALUES (:venue_id, :date, :start_time, :end_time, :session, :tickets_available, :price, :type)');
            $stmt->execute([
                ':venue_id' => $danceEvent->getVenueId(),
                ':date' => $danceEvent->getDate(),
                ':start_time' => $danceEvent->getStartTime(),
                ':end_time' => $danceEvent->getEndTime(),
                ':session' => $danceEvent->getSession(),
                ':tickets_available' => $danceEvent->getTicketsAvailable(),
                ':price' => $danceEvent->getPrice(),
                ':type' => $danceEvent->getType()
            ]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function addEventArtists($eventId, $artistId)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO event_artists (event_id, artist_id) VALUES (:event_id, :artist_id)');
            $stmt->execute([
                ':event_id' => $eventId,
                ':artist_id' => $artistId
            ]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function removeEventArtists($eventId)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM event_artists WHERE event_id = :event_id');
            $stmt->execute([':event_id' => $eventId]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function getLastInsertedEventId()
    {
        return $this->connection->lastInsertId();
    }

    public function updateDanceEvent($danceEvent)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE dance_events SET venue_id = :venue_id, date = :date, start_time = :start_time, end_time = :end_time, session = :session, tickets_available = :tickets_available, price = :price, type = :type WHERE id = :id');
            $stmt->execute([
                ':id' => $danceEvent->getId(),
                ':venue_id' => $danceEvent->getVenueId(),
                ':date' => $danceEvent->getDate(),
                ':start_time' => $danceEvent->getStartTime(),
                ':end_time' => $danceEvent->getEndTime(),
                ':session' => $danceEvent->getSession(),
                ':tickets_available' => $danceEvent->getTicketsAvailable(),
                ':price' => $danceEvent->getPrice(),
                ':type' => $danceEvent->getType()
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
            $stmt = $this->connection->prepare('SELECT artists.id, artists.name, artists.artist_image, artists.genre
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

    function getVenueNameById($id){
        try {
            $stmt = $this->connection->prepare('SELECT name FROM venues WHERE id = :id');
            $stmt->execute([':id' => $id]);

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Venue');
            $venue = $stmt->fetch();

            return $venue->getName();

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function addTicketToCart($danceTicket){
        try {
            $stmt = $this->connection->prepare('INSERT INTO tickets (id, amount, calc_price, dance_event_id, user_id) 
                                                VALUES (:id, :amount, :calc_price, :dance_event_id, :user_id)');
            $stmt->execute([
                ':id' => $danceTicket->getId(),
                ':amount' => $danceTicket->getAmount(),
                ':calc_price' => $danceTicket->getCalcPrice(),
                ':dance_event_id' => $danceTicket->getDanceEventId(),
                ':user_id' => $danceTicket->getUserId()            
            ]);
            
            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function getDanceEventPrice($id){
        try {
            $stmt = $this->connection->prepare('SELECT price FROM dance_events WHERE id = :id');
            $stmt->execute([':id' => $id]);

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Dance');
            $price = $stmt->fetch();

            return $price->getPrice();

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function areTicketsAvailable($ticket){
        try {
            $stmt = $this->connection->prepare('SELECT tickets_available FROM dance_events WHERE id = :id');
            $stmt->execute([':id' => $ticket->getDanceEventId()]);

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Dance');
            $ticketsAvailable = $stmt->fetch();

            if ($ticketsAvailable->getTicketsAvailable() >= $ticket->getAmount()) {
                return true;
            } else {
                return false;
            }

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    function ticketsAvailable($id){
        try {
            $stmt = $this->connection->prepare('SELECT tickets_available FROM dance_events WHERE id = :id');
            $stmt->execute([':id' => $id]);

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Dance');
            $dance_event = $stmt->fetch();

            return $dance_event->getTicketsAvailable();

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateTicketsAmount($id, $newTicketsAvailable){
        try {
            $stmt = $this->connection->prepare('UPDATE dance_events SET tickets_available = :tickets_available WHERE id = :id');
            $stmt->execute([
                ':id' => $id,
                ':tickets_available' => $newTicketsAvailable
            ]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}