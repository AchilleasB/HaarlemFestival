<?php

require_once(__DIR__ . '/../../services/yummy/reservationService.php');
require_once(__DIR__ . '/../../models/yummy/reservation.php');
require_once(__DIR__ . '/apiController.php');


class ReservationController extends ApiController
{
    private $reservationService;

    function __construct()
    {
        $this->reservationService = new ReservationService();
    }

    public function index()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                if(isset($_GET['restaurantId']) && isset($_GET['sessionId'])) {
                    $restaurantId = $_GET['restaurantId'];
                    $sessionId = $_GET['sessionId'];
                    echo json_encode($this->reservationService->getAvailability($sessionId, $restaurantId));
                    
                } else {
                    $this->handleGetAllRequest($this->reservationService, 'getAllCuisines');
                }
                break;
            case 'POST':
                break;
            case 'PUT':
                $this->handlePutRequest($this->reservationService, 'updateCuisine', 'getCuisineById', ['name']);
                break;
            default:
                // Handle unsupported request method
                http_response_code(405); // Method Not Allowed
                echo json_encode(["error" => "Unsupported request method"]);
                break;
        }
    }
}