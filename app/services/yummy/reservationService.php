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
        
        return $number_of_seats - $reserved_seats;
    }

    public function activateReservation($reservationId)
    {
        return $this->reservationRepository->activateReservation($reservationId);
    }

    public function deactivateReservation($reservationId)
    {
        return $this->reservationRepository->deactivateReservation($reservationId);
    }
}
?>