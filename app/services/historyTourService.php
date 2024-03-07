<?php
require_once(__DIR__ . '/../repositories/HistoryTourRepository.php');

class HistoryTourService
{
    private HistoryTourRepository $repository;

     function __construct()
    {
        $this->repository = new HistoryTourRepository();
    }

     function getAllHistoryTours()
    {
        return $this->repository->getAllHistoryTours();
    }
}
?>