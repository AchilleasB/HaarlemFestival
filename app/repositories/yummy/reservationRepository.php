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

    public function getLastReservationByRestaurantAndSessionAndUser($restaurantId, $sessionId, $userId) {
        try {
            $stmt = $this->connection->prepare('SELECT number_of_people AS reserved_seats 
                                                FROM reservations 
                                                WHERE session_id = ? 
                                                AND restaurant_id = ? 
                                                AND user_id = ?
                                                ORDER BY id DESC
                                                LIMIT 1');
            $stmt->execute([$restaurantId, $sessionId, $userId]);

            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $reservation = new Reservation($data['restaurant_id'], $data['session_id'], $data['user_id'], $data['number_of_people'], $data['mobile_number'], $data['remark'], $data['is_active']);
            $reservation->setId($data['id']);
            return $reservation;


        } catch (PDOException $e) {
            throw new RepositoryException('Error fetching last reservation', $e->getCode(), $e);
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

    public function addReservationToCart($reservation) {
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

}