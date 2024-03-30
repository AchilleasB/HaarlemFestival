<?php
require_once(__DIR__ . '/../repositories/festivalRepository.php');

class FestivalService
{
    private FestivalRepository $repository;

    function __construct()
    {
        $this->repository = new FestivalRepository();
    }
    public function getAllEvents()
    {
        return $this->repository->getAllEvents();
    }
    public function getEventDetails()
    {
        return $this->repository->getEventDetails();
    }
    public function updateEventDescription($eventId, $description)
    {
        return $this->repository->updateEventDescription($eventId, $description);
    }
    public function updateEventTitle($eventId, $title)
    {
        return $this->repository->updateEventTitle($eventId, $title);
    }
    public function updateEventTitleOverview($eventId, $title)
    {
    
        return $this->repository->updateEventTitleOverview($eventId, $title);
    }

    public function updateEventDescriptionOverview($eventId, $description)
    {

        return $this->repository->updateEventDescriptionOverview($eventId, $description);
    }

    public function updateEventSchedule($eventId, $schedule)
    {

        return $this->repository->updateEventSchedule($eventId, $schedule);
    }

    public function updateEventLocation($eventId, $location)
    {

        return $this->repository->updateEventLocation($eventId, $location);
    }
    public function updateEventSubTitle($eventId, $subTitle)
    {

        return $this->repository->updateEventSubTitle($eventId, $subTitle);
    }

}