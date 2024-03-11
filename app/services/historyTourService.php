<?php
require_once(__DIR__ . '/../repositories/HistoryTourRepository.php');

class HistoryTourService {
    private $repository;

    public function __construct() {
        $this->repository = new HistoryTourRepository();
    }

    public function getAllHistoryTours() {
        return $this->repository->getAllHistoryTours();
    }
    public function getOrganizedTours()
{
    return $this->repository->getOrganizedTours();
}
}
?>