<?php

require_once(__DIR__ . '/../../services/eventPageService.php');
require_once(__DIR__ . '/apiController.php');
require_once(__DIR__ . "/../../repositories/eventPageRepository.php");
require_once(__DIR__ . "/../../models/eventPage.php");

class EventPageController extends ApiController
{
    private $eventPageService;

    public function __construct()
    {
        $this->eventPageService = new EventPageService();
    }

    public function createEventPage()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $eventPage = $this->populateEventData();
        $success = $this->eventPageService->createEventPage($eventPage);

        if ($success) {
            $this->redirectToEventManagement();
        } else {
            $this->sendErrorResponse("Failed to create event page.");
        }
    }

    public function updateEventPage()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            return;
        }

        $eventPage = $this->populateEventData();
        $success = $this->eventPageService->updateEventPage($eventPage);

        if ($success) {
            $this->redirectToEventManagement();
        } else {
            $this->sendErrorResponse("Failed to update event page.");
        }
    }

    public function deleteEventPage()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST["eventsToDelete"])) {
            $this->sendErrorResponse("Failed to delete event page.");
            return;
        }

        $eventIds = $_POST["eventsToDelete"];

        foreach ($eventIds as $eventId) {
            $success = $this->eventPageService->deleteEventPage($eventId);
            if (!$success) {
                $this->sendErrorResponse("Failed to delete event with ID: $eventId.");
                return;
            }
        }

        $this->redirectToEventManagement();
    }

    private function populateEventData()
    {
        $eventPage = new EventPage();
        $eventPage->setId($_POST["event_id"] ?? null);
        $eventPage->setTitle($_POST["title"] ?? '');
        $eventPage->setSubTitle($_POST["subtitle"] ?? '');
        $eventPage->setDescription($_POST["description"] ?? '');
        $eventPage->setInformation($_POST["information"] ?? '');
        return $eventPage;
    }

    private function redirectToEventManagement()
    {
        header("Location: /cms/eventManagement");
        exit();
    }

    private function sendErrorResponse($message)
    {
        echo json_encode(["error" => $message]);
    }
}
