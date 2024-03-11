<?php

require_once 'repository.php';

require_once __DIR__ . '/../repositories/ticketRepository.php';

require_once __DIR__ . '/../models/eventData.php';



class ShoppingCartRepository extends Repository
{


   
function getProductData($eventId)
{
    try {
        $stmt = $this->connection->prepare("SELECT dance_events.date, dance_events.start_time, dance_events.tickets_available, dance_events.type, dance_events.price, artists.name AS artistName, artists.artist_image, venues.name, venues.address 
                                                FROM dance_events 
                                                LEFT JOIN event_artists ON dance_events.id = event_artists.event_id
                                                LEFT JOIN artists ON event_artists.artist_id = artists.id
                                                LEFT JOIN venues ON dance_events.venue_id = venues.id 
                                                WHERE dance_events.id = :id;"

                                                );
        $stmt->bindParam(':id', $eventId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $eventData = $this->createProductDataInstance($result);
        
        
        return $eventData;

    } catch (PDOException $e) {
        echo $e->getMessage() . $e->getLine();
    }





    
}

private function createProductDataInstance($result): EventData
{ 
    try{

        $eventData = new EventData();
        $eventData->setDateTime("{$result['date']} {$result['start_time']}");
        $eventData->setTicketsAvailable($result['tickets_available']);
        $eventData->setTicketPrice($result['price']);
        if (isset($result['artistName'])){
        $eventData->setName($result['artistName']);}
        else {
            $eventData->setName('');}
        if (isset($result['artist_image'])){
            $eventData->setArtistImage($result['artist_image']);}
            else {
                $eventData->setArtistImage('../images/dance_event.png');}
        $eventData->setTicketType($result['type']);
        $eventData->setLocationName($result['name']);
        $eventData->setLocationAddress($result['address']);


        return $eventData;
    } catch (Exception $e) {
        echo $e->getMessage();
    }

}




}

?>