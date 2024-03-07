<?php

require_once __DIR__ . '/controller.php';
require_once(__DIR__ . '/../services/historyService.php');
require_once(__DIR__ . '/../models/locations.php');
require_once(__DIR__ . '/../models/user.php');
require_once(__DIR__ . '/../services/locationService.php');

class HistoryController extends Controller
{
    protected $historyService;
    private LocationService $locationService;
    function __construct()
    {
        $this->historyService = new HistoryService();
        $this->locationService = new LocationService();
    }  
 
    public function index()
    {
        $locations = $this->historyService->getAllLocations(); 
        require(__DIR__ . '/../views/history/index.php');
    
    }
    public function location()
    {
        $location = $this->locationService->getLocationById();

    }

    

 
}

