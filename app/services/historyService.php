<?php
require_once(__DIR__ . '/../repositories/historyRepository.php');
require_once(__DIR__ . '/../models/locations.php');
class HistoryService
{
    private HistoryRepository $repository;

    function __construct()
    {
        $this->repository = new HistoryRepository();
    }
    public function getAllLocationsWithImages()
    {
        return $this->repository->getAllLocationsWithImages();
    }
    public function getEventDetails()
    {
        return $this->repository->getEventDetails();
    }

}