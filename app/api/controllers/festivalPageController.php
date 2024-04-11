<?php

require_once __DIR__ . '/../../services/festivalService.php';
require_once __DIR__ . '/../../models/eventOverview.php';

class FestivalPageController
{
    private $festivalService;

    public function __construct()
    {
        $this->festivalService = new FestivalService();
    }

    public function updateEventDetails()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST["events"])) {
            return;
        }

        $eventsData = $_POST["events"];

        foreach ($eventsData as $eventId => $eventDetails) {
            $event = $this->createEventOverviewFromPostData($eventId, $eventDetails);

            $success = $this->festivalService->updateEventDetails($event);

            if (!$success) {
                echo json_encode(["success" => false]);
                return;
            }
        }

        $this->redirectToFestivalManagement();
    }

    private function createEventOverviewFromPostData($eventId, $eventDetails)
    {
        $event = new EventOverview();
        $event->setId($eventId);
        $event->setTitle($eventDetails["title"] ?? "");
        $event->setSubTitle($eventDetails["subTitle"] ?? "");
        $event->setDescription($eventDetails["description"] ?? "");
        $event->setLocations($eventDetails["locations"] ?? "");
        $event->setSchedule($eventDetails["schedule"] ?? "");
        return $event;
    }

    private function redirectToFestivalManagement()
    {
        header("Location: /cms/festivalManagement");
        exit();
    }
}
