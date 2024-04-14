<?php

require_once __DIR__ . '/controller.php';
require_once(__DIR__ . '/../services/historyService.php');
require_once(__DIR__ . '/../services/locationService.php');
require_once(__DIR__ . '/../services/HistoryTourService.php');
require_once(__DIR__ . '/../models/eventPage.php');


class HistoryController extends Controller
{
    protected $historyService;
    protected $locationService;
    protected $historyTourService;

    public function __construct()
    {
        $this->historyService = new HistoryService();
        $this->locationService = new LocationService();
        $this->historyTourService = new HistoryTourService(); 
    }  

    public function index()
    {
        $locations = $this->historyService->getAllLocationsWithImages();
        $organizedTours = $this->historyTourService->getOrganizedTours();
        $languages = $this->historyTourService->getLanguages();
        $dates = $this->historyTourService->getDates();
        $times = $this->historyTourService->getTimes();
        $ticketTypes = $this->historyTourService->getTicketTypes();
        $event = $this->historyService->getEventDetails();
        
        $data = [
            'locations' => $locations,
            'organizedTours' => $organizedTours,
            'languages' => $languages,
            'dates' => $dates,
            'times' => $times,
            'ticketTypes' => $ticketTypes,
            'event' => $event
        ];

        $this->displayViewWithDataSet($this, $data);
    }
}
?>