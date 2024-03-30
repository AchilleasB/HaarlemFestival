<?php

class EventPageService
{
    private $repository;

    public function __construct(EventPageRepository $repository)
    {
        if ($repository === null) {
            $this->repository = new EventPageRepository();
        } else {
            $this->repository = $repository;
        }
    }
    public function createEventPage(EventPage $eventPage)
    {
        return $this->repository->createEventPage($eventPage);
    }
}

