<?php
require __DIR__ . '/../../services/danceService.php';
require_once __DIR__ . '/../../models/dance.php';
require_once __DIR__ . '/../../models/danceTicket.php';
require_once __DIR__ . '/../../services/ticketService.php';


class DanceEventsController
{
    private $danceService;

    function __construct()
    {
        $this->danceService = new DanceService();
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $danceEvents = $this->danceService->getAllDanceEvents();
            header('Content-Type: application/json');
            echo json_encode($danceEvents);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $this->handleDanceEventRequest('add');
        }

        if ($_SERVER["REQUEST_METHOD"] == "PUT") {
            $this->handleDanceEventRequest('edit');
        }

        if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $this->handleDanceEventRequest('delete');
        }
    }

    function handleDanceEventRequest($request_type)
    {
        $body = file_get_contents('php://input');
        $object = json_decode($body);

        if ($object === null && json_last_error() !== JSON_ERROR_NONE) {
            header('Content-Type: application/json');
            echo json_encode('Invalid JSON');
        }

        $danceEvent = new Dance();
        $danceEvent->setVenueId(htmlspecialchars($object->venue_id));
        $danceEvent->setDate(htmlspecialchars($object->date));
        $danceEvent->setStartTime(htmlspecialchars($object->start_time));
        $danceEvent->setEndTime(htmlspecialchars($object->end_time));
        $danceEvent->setSession(htmlspecialchars($object->session));
        $danceEvent->setTicketsAvailable($object->tickets_available);
        $danceEvent->setPrice($object->price);
        $danceEvent->setType(htmlspecialchars($object->type));
        $danceEvent->setArtists($object->artists);
        $danceEvent->setVenueName(htmlspecialchars($object->venue_name));

        if ($request_type === 'add') {
            if ($this->danceService->addDanceEvent($danceEvent)) {
                $message = 'A new dance event added successfully';
            } else {
                $message = 'An error occurred while adding a new dance event';
            }
        }

        if ($request_type === 'edit') {
            $danceEvent->setId(htmlspecialchars($object->id));

            if ($this->danceService->updateDanceEvent($danceEvent)) {
                $message = 'The dance event updated successfully';
            } else {
                $message = 'An error occurred while updating the dance event';
            }
        }

        if ($request_type === 'delete') {
            if ($this->danceService->deleteDanceEvent($object->id)) {
                $message = 'Dance event was deleted successfully';
            } else {
                $message = 'An error occurred while deleting the dance event';
            }
        }

        header('Content-Type: application/json');
        echo json_encode(['message' => $message, 'danceEvent' => $object]);
    }

    public function tickets()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $body = file_get_contents('php://input');
            $object = json_decode($body);

            if ($object === null && json_last_error() !== JSON_ERROR_NONE) {
                header('Content-Type: application/json');
                echo json_encode('Invalid JSON');
            }

            $danceTicket = new DanceTicket();
            $danceTicket->setAmount(htmlspecialchars($object->amount));
            $danceTicket->setEventId(htmlspecialchars($object->event_id));
            $danceTicket->setUserId(htmlspecialchars($object->user_id));

            if ($object->amount === 0) {
                $message = 'Invalid amount! Try again with a valid amount of tickets';
            } elseif ($this->danceService->addTicketToCart($danceTicket)) {
                $message = 'Ticket(s) added to cart successfully';
                
                $ticketService = new TicketService();
                $previousDanceTicketId = $ticketService->retrievePreviousDanceTicketId();
               $danceTicket->setId($previousDanceTicketId);
                $_SESSION['order_items_data'][count($_SESSION['order_items_data'])]=$danceTicket;

            } else {
                $message = 'An error occurred while adding ticket(s) to cart';
            }

            header('Content-Type: application/json');
            echo json_encode(['message' => $message, 'danceTicket' => $danceTicket]);
        }
    }

}