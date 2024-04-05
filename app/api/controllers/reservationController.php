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
                if (isset($_GET['restaurantId']) && isset($_GET['sessionId'])) {
                    $restaurantId = $_GET['restaurantId'];
                    $sessionId = $_GET['sessionId'];
                    echo json_encode($this->reservationService->getAvailability($sessionId, $restaurantId));
                } elseif (isset($_GET['sessionId'])) {
                    $sessionId = $_GET['sessionId'];
                    $reservationWarningData = $this->reservationService->getReservationWaningDataBySessionId($sessionId);
                    echo json_encode($reservationWarningData);
                } else {
                    $this->handleGetAllRequest($this->reservationService, 'getAllReservations');
                }
                break;
            case 'POST':
                $this->handleUpdateReservation();
                break;
            case 'PUT':
                $this->handleReservationActivation();
                break;
            default:
                // Handle unsupported request method
                http_response_code(405); // Method Not Allowed
                echo json_encode(["error" => "Unsupported request method"]);
                break;
        }
    }

    private function handleUpdateReservation()
    {
        $id = isset($_POST['id']) ? htmlspecialchars($_POST['id']) : 0;
        $numberOfPeople = isset($_POST['guests']) ? htmlspecialchars($_POST['guests']) : 1;
        $mobileNumber = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
        $remark = !empty($_POST['remark']) ? htmlspecialchars($_POST['remark']) : null;
        $this->reservationService->UpdateReservation($id, $numberOfPeople, $mobileNumber, $remark);

        echo json_encode(["message" => "Reservation updated successfully"]);
    }

    private function handleReservationActivation()
    {
        if (!isset($_GET['id'])) {
            http_response_code(400);
            echo json_encode(["error" => "ID parameter missing"]);
            return;
        }

        $id = $_GET['id'];
        if (!is_numeric($id)) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid ID"]);
            return;
        }
        $isActive = $this->reservationService->getActiveStatusByReservationId($id);
        if ($isActive) {
            $this->reservationService->deactivateReservation($id);
            echo json_encode(["message" => "Reservation deactivated successfully"]);
        } else {
            $this->reservationService->activateReservation($id);
            echo json_encode(["message" => "Reservation activated successfully"]);
        }        
    }
}
