<?php

require_once(__DIR__ . '/../../services/yummy/sessionService.php');
require_once(__DIR__ . '/../../models/yummy/session.php');
require_once(__DIR__ . '/apiController.php');


class SessionController extends ApiController
{
    private $sessionService;

    function __construct()
    {
        $this->sessionService = new SessionService();
    }

    public function index()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->handleGetAllRequest($this->sessionService, 'getAllSessions');
                break;
            case 'POST':
                $this->handlePostSessionsRequest();
                break;
            case 'PUT':
                $this->handlePutSessionRequest();
                break;
            case 'DELETE':
                $this->handleDeleteRequest($this->sessionService, 'deleteSession');
                break;
            default:
                // Handle unsupported request method
                http_response_code(405); // Method Not Allowed
                echo json_encode(["error" => "Unsupported request method"]);
                break;
        }
    }

    private function handlePutSessionRequest()
    {
        $this->sendHeaders();
        $body = file_get_contents('php://input');
        $object = json_decode($body);

        $startDate = DateTime::createFromFormat('Y-m-d\TH:i', $object->start_date);
        $endDate = DateTime::createFromFormat('Y-m-d\TH:i', $object->end_date);
        $session = $this->sessionService->getSessionById($object->id);
        $session->setStartDate($startDate);
        $session->setEndDate($endDate);
        $this->sessionService->updateSession($session);

        echo json_encode(["message" => "Session updated successfully"]);
    }

    private function handlePostSessionsRequest()
    {
        $body = file_get_contents('php://input');
        $object = json_decode($body);

        if ($object === null && json_last_error() !== JSON_ERROR_NONE) {
            header('Content-Type: application/json');
            echo json_encode('Invalid JSON');
        }

        $startDate = DateTime::createFromFormat('Y-m-d\TH:i', $object->start_date);
        $endDate = DateTime::createFromFormat('Y-m-d\TH:i', $object->end_date);
        $session = new Session($startDate, $endDate);
        $this->sessionService->addSession($session);
        echo json_encode(["message" => "Session added successfully"]);
    }
}
