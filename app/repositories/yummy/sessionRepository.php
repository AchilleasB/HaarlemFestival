<?php

require_once __DIR__ . '/../repository.php';
require_once __DIR__ . '/../../models/yummy/session.php';

class SessionRepository extends Repository
{
    public function getAllSessions()
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM sessions');
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Session');
            $sessions = $stmt->fetchAll();

            return $sessions;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function fetchSessionsForRestaurant($restaurantId): array {
        $sessions = [];
        try {
            $stmt = $this->connection->prepare("
                SELECT s.id, s.start_date, s.end_date
                FROM sessions s
                JOIN restaurants_sessions rs ON s.id = rs.session_id
                WHERE rs.restaurant_id = ?
            ");
            $stmt->execute([$restaurantId]);
    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $sessions[] = new Session(
                    $row['id'],
                    new DateTime($row['start_date']),
                    new DateTime($row['end_date'])
                );
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $sessions;
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
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function updateSession($session)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE sessions SET start_date = :start_date, end_date = :end_date WHERE id = :id');
            $stmt->execute([
                ':id' => $session->getId(),
                ':start_date' => $session->getStartDate()->format('Y-m-d H:i:s'),
                ':end_date' => $session->getEndDate()->format('Y-m-d H:i:s'),
            ]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function deleteSession($id)
    {
        try {
            $stmt = $this->connection->prepare('DELETE FROM sessions WHERE id = :id');
            $stmt->execute([':id' => $id]);

            return true;

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
}
