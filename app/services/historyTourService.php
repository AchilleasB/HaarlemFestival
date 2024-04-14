<?php
require_once(__DIR__ . '/../repositories/historyTourRepository.php');


class HistoryTourService {
    private $repository;

    public function __construct() {
        $this->repository = new HistoryTourRepository();
    }

    public function getAllTours() {
        return $this->repository->getAllTours();
    }
    public function getAllGuides() {
        return $this->repository->getAllGuides();
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
    public function createTour(HistoryTour $tour)
    {
        return $this->repository->createTour($tour);
    }

    public function updateTour(HistoryTour $tour)
    {  
        return $this->repository->updateTour($tour);
    }

    public function deleteTour($tourId)
    {   
        return $this->repository->deleteTour($tourId);
    }
    public function createGuide(Guide $guide) {
        return $this->repository->createGuide($guide);
    }

    public function updateGuide(Guide $guide) {
        return $this->repository->updateGuide($guide);
    }

    public function deleteGuide($id) {
        return $this->repository->deleteGuide($id);
    }

    
}

?>