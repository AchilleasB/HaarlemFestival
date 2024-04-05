<?php

require_once(__DIR__ . '/../../repositories/yummy/reservationRepository.php');
require_once(__DIR__ . '/../../repositories/yummy/restaurantRepository.php');
require_once(__DIR__ . '/../../models/yummy/reservation.php');


class ReservationService
{
    private $reservationRepository;
    private $restaurantRepository;

    public function __construct()
    {
        $this->reservationRepository = new ReservationRepository();
        $this->restaurantRepository = new RestaurantRepository();
    }

    public function addReservation($reservation)
    {
        return $this->reservationRepository->addReservation($reservation);
    }

    public function getAvailability($sessionId, $restaurantId)
    {
        $number_of_seats = $this->restaurantRepository->getSeatsById($restaurantId);
        $reserved_seats = $this->reservationRepository->getReservedSeatsForSessionAndRestaurant($sessionId, $restaurantId);

        $availability = $number_of_seats - $reserved_seats;

        // Check if availability is less than 0, then set it to 0
        if ($availability < 0) {
            $availability = 0;
        }

        return $availability;
    }


    public function activateReservation($reservationId)
    {
        return $this->reservationRepository->activateReservation($reservationId);
    }

    public function deactivateReservation($reservationId)
    {
        return $this->reservationRepository->deactivateReservation($reservationId);
    }

    public function addReservationToCart($reservation)
    {
        return $this->reservationRepository->addReservationToCart($reservation);
    }

    public function getLastReservationByRestaurantAndSessionAndUser($restaurantId, $sessionId, $userId)
    {
        return $this->reservationRepository->getLastReservationByRestaurantAndSessionAndUser($restaurantId, $sessionId, $userId);
    }

    public function getReservationWaningDataBySessionId($sessionId)
    {
        return $this->reservationRepository->getReservationWaningDataBySessionId($sessionId);
    }

    public function getAllReservations()
    {
        return $this->reservationRepository->getAllReservationsPrettyData();
    }

    public function UpdateReservation($id, $numberOfPeople, $mobileNumber, $remark)
    {
        return $this->reservationRepository->UpdateReservation($id, $numberOfPeople, $mobileNumber, $remark);
    }

    public function getActiveStatusByReservationId($reservationId)
    {
        return $this->reservationRepository->getActiveStatusByReservationId($reservationId);
    }
}