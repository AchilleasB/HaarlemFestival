<?php

require_once(__DIR__ . '/../repository.php');
require_once(__DIR__ . '/../../exceptions/baseException.php');
require_once(__DIR__ . '/../../exceptions/repositoryException.php');
require_once(__DIR__ . '/../../models/yummy/reservation.php');
require_once(__DIR__ . '/../../models/yummy/reservationWarningData.php');
require_once(__DIR__ . '/../../models/yummy/reservationCms.php');

class ReservationRepository extends Repository
{
    public function addReservation($reservation)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO reservations (restaurant_id, session_id, user_id, number_of_people, mobile_number, remark, is_active) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $stmt->execute([
                $reservation->getRestaurantId(),
                $reservation->getSessionId(),
                $reservation->getUserId(),
                $reservation->getNumberOfPeople(),
                $reservation->getMobileNumber(),
                $reservation->getRemark(),
                $reservation->getIsActive() ? 1 : 0
            ]);
        } catch (PDOException $e) {
            throw new RepositoryException('Error adding reservation', $e->getCode(), $e);
        }
    }

    public function getLastReservationByRestaurantAndSessionAndUser($restaurantId, $sessionId, $userId)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM reservations WHERE restaurant_id = ? AND session_id = ? AND user_id = ? ORDER BY ID DESC LIMIT 1;');
            $stmt->execute([$restaurantId, $sessionId, $userId]);

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $reservation = new Reservation($data['restaurant_id'], $data['session_id'], $data['user_id'], $data['number_of_people'], $data['mobile_number'], $data['remark'], $data['is_active']);
            $reservation->setId($data['id']);
            return $reservation;
        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching last reservation', $e->getCode(), $e);
        }
    }

    public function getReservedSeatsForSessionAndRestaurant($sessionId, $restaurantId)
    {
        try {
            $stmt = $this->connection->prepare('SELECT SUM(number_of_people) AS reserved_seats FROM reservations WHERE session_id = ? AND restaurant_id = ? AND is_active = 1');
            $stmt->execute([$sessionId, $restaurantId]);

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data['reserved_seats'];
        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching reserved seats', $e->getCode(), $e);
        }
    }

    public function activateReservation($reservationId)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE reservations SET is_active = 1 WHERE id = ?');
            $stmt->bindParam(":id", $reservationId);
            $stmt->execute([$reservationId]);
        } catch (PDOException $e) {
            throw new RepositoryException('Error activating reservation', $e->getCode(), $e);
        }
    }

    public function deactivateReservation($reservationId)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE reservations SET is_active = 0 WHERE id = ?');
            $stmt->execute([$reservationId]);
        } catch (PDOException $e) {
            throw new RepositoryException('Error deactivating reservation', $e->getCode(), $e);
        }
    }

    public function addReservationToCart($reservation)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO tickets (id, amount, calc_price, reservation_id, user_id) 
            VALUES (:id, :amount, :calc_price, :reservation_id, :user_id)');
            $stmt->execute([
                ':id' => $reservation->getId(),
                ':amount' => $reservation->getAmount(),
                ':calc_price' => $reservation->getCalcPrice(),
                ':reservation_id' => $reservation->getReservationId(),
                ':user_id' => $reservation->getUserId()
            ]);
        } catch (PDOException $e) {
            throw new RepositoryException('Error adding reservation to cart', $e->getCode(), $e);
        }
    }

    public function getReservationIdByTicketId($ticketId)
    {
        try {

            $query = $this->connection->prepare("SELECT reservation_id FROM  tickets WHERE id=:id ");
            $query->bindParam(":id", $ticketId);
            $query->execute();

            $query->setFetchMode(PDO::FETCH_ASSOC);
            $row = $query->fetch();
            return $row['reservation_id'];
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getLine();
        }
    }

    public function deactivateReservationsBySessionId($sessionId)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE reservations SET is_active = 0 WHERE session_id = ?');
            $stmt->execute([$sessionId]);
        } catch (PDOException $e) {
            throw new RepositoryException('Error deactivating reservations', $e->getCode(), $e);
        }
    }

    public function getReservationWaningDataBySessionId($sessionId)
    {
        try {
            $stmt = $this->connection->prepare('SELECT
                                                COUNT(id) AS total_reservations,
                                                SUM(number_of_people) AS total_people,
                                                COUNT(DISTINCT restaurant_id) AS number_of_restaurants
                                                FROM
                                                    reservations
                                                WHERE
                                                    is_active = 1
                                                    AND session_id = ?
                                                GROUP BY
                                                    session_id;
                                                ');
            $stmt->execute([$sessionId]);

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$data) return null;
            $reservationWarningData = new ReservationWarningData($data['total_reservations'], $data['total_people'], $data['number_of_restaurants']);
            return $reservationWarningData;
        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching reservation warning data', $e->getCode(), $e);
        }
    }

    public function getAllReservationsPrettyData()
    {
        try {
            $stmt = $this->connection->prepare('SELECT
                                                    reservations.id,
                                                    restaurants.name AS restaurant_name,
                                                    users.lastname AS user_name,
                                                    sessions.start_date AS session_start,
                                                    sessions.end_date AS session_end,
                                                    reservations.number_of_people,
                                                    reservations.mobile_number,
                                                    reservations.remark,
                                                    reservations.is_active
                                                FROM
                                                    reservations
                                                LEFT JOIN restaurants ON reservations.restaurant_id = restaurants.id
                                                LEFT JOIN sessions ON reservations.session_id = sessions.id
                                                LEFT JOIN users ON reservations.user_id = users.id
                                                ORDER BY
                                                    reservations.id ASC;        
                                                ');
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $reservations = [];
            foreach ($data as $row) {
                // Conditionally create DateTime objects or use null based on the database values
                $sessionStart = $row['session_start'] ? new DateTime($row['session_start']) : null;
                $sessionEnd = $row['session_end'] ? new DateTime($row['session_end']) : null;

                $reservation = new ReservationCms(
                    $row['restaurant_name'],
                    $sessionStart,
                    $sessionEnd,
                    $row['user_name'],
                    $row['number_of_people'],
                    $row['mobile_number'],
                    $row['remark'],
                    $row['is_active']
                );
                $reservation->setId($row['id']);
                $reservations[] = $reservation;
            }
            return $reservations;
        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching all reservations pretty data', $e->getCode(), $e);
        }
    }

    public function UpdateReservation($id, $numberOfPeople, $mobileNumber, $remark)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE reservations SET number_of_people = ?, mobile_number = ?, remark = ? WHERE id = ?');
            $stmt->execute([$numberOfPeople, $mobileNumber, $remark, $id]);
        } catch (PDOException $e) {
            throw new RepositoryException('Error updating reservation', $e->getCode(), $e);
        }
    }

    public function getActiveStatusByReservationId($reservationId)
    {
        try {
            $stmt = $this->connection->prepare('SELECT is_active FROM reservations WHERE id = ?');
            $stmt->execute([$reservationId]);

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data['is_active'];
        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching active status by reservation id', $e->getCode(), $e);
        }
    }
}
