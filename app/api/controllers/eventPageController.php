<?php

require_once(__DIR__ . '/../../services/eventPageService.php');
require_once(__DIR__ . '/apiController.php');


class EventPageController extends ApiController
{
    private $eventPageService;

    function __construct()
    {
        $this->eventPageService = new EventPageService();
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->handleGetAllRequest($this->eventPageService, 'getAllEventPageTitles');
        } else {
            // Handle unsupported request method
            http_response_code(405); // Method Not Allowed
            echo json_encode(["error" => "Unsupported request method"]);
        }
    }
}
