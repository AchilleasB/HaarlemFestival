<?php

require_once __DIR__ . '/controller.php';
require_once(__DIR__ . '/../models/eventPage.php');
require_once(__DIR__ . '/../services/eventPageService.php');


class EventController extends Controller
{
    protected $eventPageService;

    public function __construct()
    {
        $this->eventPageService = new EventPageService(); 
        
    }  

    public function index()
    {
        $eventId = isset($_GET['eventId']) ? $_GET['eventId'] : null;
        
        $event = $this->eventPageService->getEventPageById($eventId);
        $data = [
            'event' => $event
        ];

        $this->displayViewWithDataSet($this, $data);
    } 
}
?>