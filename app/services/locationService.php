<?php
require_once(__DIR__ . '/../repositories/LocationRepository.php');
require_once(__DIR__ . '/../models/locations.php');

class LocationService
{
    private LocationRepository $locationRepository;

    public function getAll(): array|null
    {
        return $this->locationRepository->getAll();
    }
    public function __construct()
    {
        $this->locationRepository = new LocationRepository();
    }

    public function getLocationById(): Location|null
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            return $this->locationRepository->getLocationById($id);
        } else {
            return null;
        }
    }


    public function createNewLocation(Location $newLocation)
    {
        return $this->locationRepository->createNewLocation($newLocation);
    }




    public function updateLocation(Location $location)
    {

        $this->locationRepository->updateLocation($location);
    }

    public function deleteLocation()
    {
        if (isset($_GET['id'])) {
            $this->locationRepository->deleteLocation($_GET['id']);
        }
    }

}