<?php
require_once(__DIR__ . '/../repositories/HistoryRepository.php');
require_once(__DIR__ . '/../models/locations.php');
class HistoryService
{
    private HistoryRepository $repository;

    function __construct()
    {
        $this->repository = new HistoryRepository();
    }
    function getAllLocations()
    {
        return $this->repository->getAllLocations();
    }

}