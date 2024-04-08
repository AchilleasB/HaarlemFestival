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

    public function createLocation(Location $location)
    {
        return $this->locationRepository->createLocation($location);
    }
    public function updateLocation(Location $location)
    {
        return $this->locationRepository->updateLocation($location);
    }

    public function deleteLocation($locationId)
    {
        return $this->locationRepository->deleteLocation($locationId);
    }

}