<?php

require_once(__DIR__ . '/../repository.php');
require_once(__DIR__ . '/../../exceptions/baseException.php');
require_once(__DIR__ . '/../../exceptions/repositoryException.php');
require_once(__DIR__ . '/../../models/yummy/reservation.php');

class ReservationRepository extends Repository {
    public function addReservation($reservation) {
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

    public function getReservedSeatsForSessionAndRestaurant($sessionId, $restaurantId) {
        try {
            $stmt = $this->connection->prepare('SELECT SUM(number_of_people) AS reserved_seats FROM reservations WHERE session_id = ? AND restaurant_id = ? AND is_active = 1');
            $stmt->execute([$sessionId, $restaurantId]);

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data['reserved_seats'];

        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching reserved seats', $e->getCode(), $e);
        }
    }

    public function activateReservation($reservationId) {
        try {
            $stmt = $this->connection->prepare('UPDATE reservations SET is_active = 1 WHERE id = ?');
            $stmt->execute([$reservationId]);

        } catch (PDOException $e) {
            throw new RepositoryException('Error activating reservation', $e->getCode(), $e);
        }
    }

    public function deactivateReservation($reservationId) {
        try {
            $stmt = $this->connection->prepare('UPDATE reservations SET is_active = 0 WHERE id = ?');
            $stmt->execute([$reservationId]);

        } catch (PDOException $e) {
            throw new RepositoryException('Error deactivating reservation', $e->getCode(), $e);
        }
    }

}