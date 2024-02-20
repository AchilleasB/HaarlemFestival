<?php
require __DIR__ . '/../repositories/venueRepository.php';
require_once __DIR__ . '/../models/venue.php';

class VenueService
{
    private $venueRepository;

    function __construct()
    {
        $this->venueRepository = new VenueRepository();
    }

    public function getAllVenues()
    {
        return $this->venueRepository->getAllVenues();
    }

    public function addVenue($venue)
    {
        return $this->venueRepository->addVenue($venue);
    }

    public function updateVenue($venue)
    {
        return $this->venueRepository->updateVenue($venue);
    }

    public function deleteVenue($id)
    {
        return $this->venueRepository->deleteVenue($id);
    }

}