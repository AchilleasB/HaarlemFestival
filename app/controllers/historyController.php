<?php

require_once __DIR__ . '/controller.php';
require_once(__DIR__ . '/../services/historyService.php');
require_once(__DIR__ . '/../models/locations.php');
require_once(__DIR__ . '/../models/user.php');
require_once(__DIR__ . '/../services/locationService.php');
require_once(__DIR__ . '/../services/HistoryTourService.php');

class HistoryController extends Controller
{
    protected $historyService;
    protected $locationService;
    protected $historyTourService;

    function __construct()
    {
        $this->historyService = new HistoryService();
        $this->locationService = new LocationService();
        $this->historyTourService = new HistoryTourService(); 
    }  

    public function index()
    {
        $locations = $this->historyService->getAllLocationsWithImages();
        $historyTours = $this->historyTourService->getAllHistoryTours();
        $locationService = $this->locationService;
        $organizedTours = $this->historyTourService->getOrganizedTours();
        require(__DIR__ . '/../views/history/index.php');
    }

    public function location()
    {
        $location = $this->locationService->getLocationById();
        $images = $this->locationService->getLocationImages();
    }
}
?>
