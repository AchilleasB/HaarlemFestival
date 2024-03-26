<?php

require_once(__DIR__ . '/../../repositories/yummy/sessionRepository.php');

class SessionService {
    private $sessionRepository;

    public function __construct() {
        $this->sessionRepository = new SessionRepository();
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
        // list($startDateTime, $endDateTime) = $this->validateDates($startDate, $endDate);

        // $session = new Session();
        // $session->setStartDate($startDateTime);
        // $session->setEndDate($endDateTime);
        
        return $this->sessionRepository->addSession($session);
    }

    public function updateSession($session) {
        // list($validatedStartDate, $validatedEndDate) = $this->validateDates($session->getStartDate(), $session->getEndDate());
    
        // $session->setStartDate($validatedStartDate);
        // $session->setEndDate($validatedEndDate);
        
        return $this->sessionRepository->updateSession($session);
    }
    

    public function deleteSession($id) {
        return $this->sessionRepository->deleteSession($id);
    }

    private function validateDates($startDate, $endDate) {
        $startDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $startDate);
        $endDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $endDate);

        if ($startDateTime === false || $endDateTime === false) {
            throw new Exception("Invalid date format. Please use 'Y-m-d H:i:s'.");
        }

        if ($startDateTime >= $endDateTime) {
            throw new Exception("Start date must be before end date.");
        }

        return [$startDateTime, $endDateTime];
    }
}