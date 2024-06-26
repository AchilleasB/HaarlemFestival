<?php

require_once(__DIR__ . '/../repositories/eventPageRepository.php');

class EventPageService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new EventPageRepository();
    }
    public function getAllEvents()
    {
        return $this->repository->getAllEvents();
    }
    public function createEventPage(EventPage $eventPage)
    {
        return $this->repository->createEventPage($eventPage);
    }
    public function updateEventPage(EventPage $eventPage)
    {
        return $this->repository->updateEventPage($eventPage);
    }
    public function deleteEventPage($eventId)
    {
        return $this->repository->deleteEventPage($eventId);
    }
    public function getEventPageById($eventId)
    {
        return $this->repository->getEventPageById($eventId);
    }
    public function getAllEventPageTitles()
    {
        return $this->repository->getAllEventPageTitles();
    }
}
