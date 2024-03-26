<?php

require_once(__DIR__ . '/../repository.php');
require_once(__DIR__ . '/../../models/yummy/session.php');

class SessionRepository extends Repository
{
    public function getAllSessions()
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM sessions');
            $stmt->execute();

            $sessionData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $sessions = [];
            foreach ($sessionData as $data) {
                $startDate = new DateTime($data['start_date']);
                $endDate = new DateTime($data['end_date']);
                $session = new Session($startDate, $endDate);
                $session->setId($data['id']);
                $sessions[] = $session;
            }

            return $sessions;

        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching sessions', $e->getCode(), $e);
        }
    }

    public function getSessionById($sessionId): Session {
        try {
            $stmt = $this->connection->prepare("
                SELECT id, start_date, end_date
                FROM sessions
                WHERE id = ?
            ");
            $stmt->execute([$sessionId]);
    
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$data) {
                throw new RepositoryException('No session found for ID ' . $sessionId, 404);
            }
            
            $startDate = new DateTime($data['start_date']);
            $endDate = new DateTime($data['end_date']);
            $session = new Session($startDate, $endDate);
            $session->setId($data['id']);
    
            return $session;
        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching session by ID', $e->getCode(), $e);
        }
    }

    public function getSessionsByRestaurantId($restaurantId): array {
        $sessions = [];
        try {
            $stmt = $this->connection->prepare("
                SELECT s.id, s.start_date, s.end_date
                FROM sessions s
                JOIN restaurants_sessions rs ON s.id = rs.session_id
                WHERE rs.restaurant_id = ?
            ");
            $stmt->execute([$restaurantId]);
    
            $sessionData = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $sessions = [];
            foreach ($sessionData as $data) {
                // Convert start_date and end_date to DateTime objects
                $startDate = new DateTime($data['start_date']);
                $endDate = new DateTime($data['end_date']);
            
                // Pass DateTime objects to Session constructor
                $session = new Session($startDate, $endDate);
                $session->setId($data['id']);
                $sessions[] = $session;
            }
    
            return $sessions;
        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching sessions', $e->getCode(), $e);
        }
    }

    public function addSession($session)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO sessions (start_date, end_date) VALUES (:start_date, :end_date)');
            $stmt->execute([
                ':start_date' => $session->getStartDate()->format('Y-m-d H:i:s'),
                ':end_date' => $session->getEndDate()->format('Y-m-d H:i:s'),
            ]);

            return true;

        } catch (PDOException $e) {
            throw new RepositoryException('Error adding session', $e->getCode(), $e);
        }
    }

    public function updateSession($session)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE sessions SET start_date = ?, end_date = ? WHERE id = ?');
            $stmt->execute([
                $session->getStartDate()->format('Y-m-d H:i:s'),
                $session->getEndDate()->format('Y-m-d H:i:s'),
                $session->getId(),
            ]);

            return true;

        } catch (PDOException $e) {
            throw new RepositoryException('Error updating session', $e->getCode(), $e);
        }
    }

    public function deleteSession($sessionId)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM sessions WHERE id = :id');
            $stmt->execute([':id' => $sessionId]);

            return true;

        } catch (PDOException $e) {
            throw new RepositoryException('Error deleting session', $e->getCode(), $e);
        }
    }
}