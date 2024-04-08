<?php

require_once(__DIR__ . '/../../repositories/yummy/sessionRepository.php');
require_once(__DIR__ . '/../../repositories/yummy/reservationRepository.php');

class SessionService {
    private $sessionRepository;
    private $reservationRepository;

    public function __construct() {
        $this->sessionRepository = new SessionRepository();
        $this->reservationRepository = new ReservationRepository();
    }

    public function getAllSessions() {
        return $this->sessionRepository->getAllSessions();
    }

    public function getSessionById($sessionId) {
        return $this->sessionRepository->getSessionById($sessionId);
    }

    public function getSessionsByRestaurantId($restaurantId) {
        return $this->sessionRepository->getSessionsByRestaurantId($restaurantId);
    }
    
    public function addSession($session) {
        list($validatedStartDate, $validatedEndDate) = $this->validateDates($session->getStartDate(), $session->getEndDate());
    
        $session->setStartDate($validatedStartDate);
        $session->setEndDate($validatedEndDate);
        
        return $this->sessionRepository->addSession($session);
    }

    public function updateSession($session) {
        list($validatedStartDate, $validatedEndDate) = $this->validateDates($session->getStartDate(), $session->getEndDate());
    
        $session->setStartDate($validatedStartDate);
        $session->setEndDate($validatedEndDate);
        
        return $this->sessionRepository->updateSession($session);
    }
    

    public function deleteSession($id) {
        $this->reservationRepository->deactivateReservationsBySessionId($id);
        return $this->sessionRepository->deleteSession($id);
    }

    private function validateDates($startDate, $endDate) {

        if ($startDate >= $endDate) {
            throw new Exception("Start date must be before end date.");
        }

        return [$startDate, $endDate];
    }
}