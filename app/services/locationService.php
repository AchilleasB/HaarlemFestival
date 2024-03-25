<?php
require_once(__DIR__ . '/../repositories/locationRepository.php');
require_once(__DIR__ . '/../models/locations.php');

class LocationService
{
    private LocationRepository $locationRepository;

    public function __construct()
    {
        $this->locationRepository = new LocationRepository();
    }
    public function getAllLocations()
    {
        return $this->locationRepository->getAllLocations();
    }

    public function addLocation($location)
    {
        return $this->locationRepository->addLocation($artist);
    }

    public function updateLocation($location)
    {
        return $this->locationRepository->updateLocation($artist);
    }

    public function deleteLocation($id)
    {
        return $this->locationRepository->deleteLocation($id);
    }

}