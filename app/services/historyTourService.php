<?php
require_once(__DIR__ . '/../repositories/historyTourRepository.php');


class HistoryTourService {
    private $repository;

    public function __construct() {
        $this->repository = new HistoryTourRepository();
    }

    public function getOrganizedTours() {
        return $this->repository->getOrganizedTours();
    }

    public function getLanguages() {
        return $this->repository->getLanguages();
    }

    public function getDates() {
        return $this->repository->getDates();
    }

    public function getTimes() {
        return $this->repository->getTimes();
    }

    public function getTicketTypes() {
        return $this->repository->getTicketTypes();
    }

    public function checkForMatchingTour($language, $date, $time) {
        return $this->repository->checkForMatchingTour($language, $date, $time);
    }

    public function getAvailableSeats($language, $date, $time) {
        return $this->repository->getAvailableSeats($language, $date, $time);
    }

    public function getTicketTypePrice($ticketType) {
        return $this->repository->getTicketTypePrice($ticketType);
    }

    public function addTicketToCart($historyTicket) {
        return $this->repository->addTicketToCart($historyTicket);
    }
    public function updateSeats($historyTourId, $seatsToDeduct){
        return $this->repository->updateSeats($historyTourId, $seatsToDeduct);
    }
    
}

?>