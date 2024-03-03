<?php
require __DIR__ . '/../repositories/danceRepository.php';
require_once __DIR__ . '/../models/dance.php';

class DanceService
{
    private $danceRepository;

    function __construct()
    {
        $this->danceRepository = new DanceRepository();
    }

    public function getAllDanceEvents()
    {
        $danceEvents = $this->danceRepository->getAllDanceEvents();
        
        foreach ($danceEvents as $danceEvent) {
            $eventId = $danceEvent->getId();
            $artists = $this->danceRepository->getEventArtists($eventId);
            $danceEvent->setArtists($artists);
    
            $venueId = $danceEvent->getVenueId();
            $venueName = $this->danceRepository->getVenueNameById($venueId);
            $danceEvent->setVenueName($venueName);
        }
    
        return $danceEvents;
    }

    public function addDanceEvent($danceEvent)
    {
        $savedEvent = $this->danceRepository->addDanceEvent($danceEvent);
        if ($savedEvent) {
            $eventId = $this->danceRepository->getLastInsertedEventId();
            $artists = $danceEvent->getArtists();

            foreach ($artists as $artistId) {
                $this->danceRepository->addEventArtists($eventId, $artistId);
            }
        }
        
        return $savedEvent;
    }

    public function updateDanceEvent($danceEvent)
    {
        return $this->danceRepository->updateDanceEvent($danceEvent);
    }

    public function deleteDanceEvent($id)
    {
        return $this->danceRepository->deleteDanceEvent($id);
    }

    public function getEventArtists($id)
    {
        return $this->danceRepository->getEventArtists($id);   
    }

    function addTicketToCart($danceTicket) {
        return $this->danceRepository->addTicketToCart($danceTicket);
    }

}