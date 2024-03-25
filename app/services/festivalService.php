<?php
require_once(__DIR__ . '/../repositories/festivalRepository.php');

class FestivalService
{
    private FestivalRepository $repository;

    function __construct()
    {
        $this->repository = new FestivalRepository();
    }
    public function getAllEvents()
    {
        return $this->repository->getAllEvents();
    }
    public function getEventDetails()
    {
        return $this->repository->getEventDetails();
    }

}