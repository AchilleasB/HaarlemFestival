<?php

require_once __DIR__ . '/controller.php';
require_once(__DIR__ . '/../services/festivalService.php');
require_once(__DIR__ . '/../models/eventPage.php');

class FestivalController extends Controller
{
    protected $festivalService;

    function __construct()
    {
        $this->festivalService = new FestivalService();
    }
    public function index()
    {
        $events = $this->festivalService->getAllEvents();
        $event = $this->festivalService->getEventDetails();
        
        $data = [
            'events' => $events,
            'event' => $event
        ];

        $this->displayViewWithDataSet($this, $data);
    }
}