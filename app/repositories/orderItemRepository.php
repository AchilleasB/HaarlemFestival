<?php

require_once 'repository.php';

require_once __DIR__ . '/../repositories/ticketRepository.php';

require_once __DIR__ . '/../models/eventData.php';



class OrderItemRepository extends Repository
{

function getEventDataTable($ticketId){

try{

    $stmt = $this->connection->prepare("SELECT * FROM tickets WHERE id = :id;");
    $stmt->bindParam(':id', $ticketId);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    

    if ($result['dance_event_id']!= NULL){

        $eventTableData = [ "table" => "dance_events", "event_id" => $result['dance_event_id']];
    }
    else if($result['history_tour_id'] != NULL){
        $eventTableData = [ "table" => "history_tours", "event_id" => $result['history_tour_id']];
    }

    return $eventTableData;

    } catch (PDOException $e) {
    echo $e->getMessage() . $e->getLine();
    }

} 


function getProductData($ticketId){

    $eventDataTable = $this->getEventDataTable($ticketId);

    if ($eventDataTable["table"] == "dance_events"){
        $res = $this->getDanceEventData($eventDataTable["event_id"]);
    }
    if ($eventDataTable["table"] == "history_tours"){
        $res = $this->getTourEventData($eventDataTable["event_id"]);
    }

    return $res;
}
   


function getDanceEventData($eventId)
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

        $eventData = $this->createDanceEventDataInstance($result);
        
        
        return $eventData;

    } catch (PDOException $e) {
        echo $e->getMessage() . $e->getLine();
    }

}


function getTourEventData($eventId)
{
    try {
        $stmt = $this->connection->prepare("SELECT history_tours.date, history_tours.time, history_tours.seats
                                                FROM history_tours
                                                WHERE history_tours.id = :id;"

                                                );
        $stmt->bindParam(':id', $eventId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $eventData = $this->createTourEventDataInstance($result);
        
        
        return $eventData;

    } catch (PDOException $e) {
        echo $e->getMessage() . $e->getLine();
    }

}

private function createDanceEventDataInstance($result): EventData
{ 
    try{

        $eventData = new EventData();
        $eventData->setDateTime("{$result['date']} {$result['start_time']}");
        $eventData->setTicketsAvailable($result['tickets_available']);
        $eventData->setTicketPrice($result['price']);
        if (isset($result['artistName'])){
        $eventData->setName($result['artistName']);}
        else {
            $eventData->setName('Dance!'.$result['type']);}
        if (isset($result['artist_image'])){
            $eventData->setArtistImage($result['artist_image']);}
            else {
                $eventData->setArtistImage('../images/dance.png');}
        $eventData->setHistoryTourImage(NULL);
        $eventData->setTicketType($result['type']);
        $eventData->setLocationName($result['name']);
        $eventData->setLocationAddress($result['address']);


        return $eventData;
    } catch (Exception $e) {
        echo $e->getMessage();
    }

}


private function createTourEventDataInstance($result): EventData
{ 
    try{

        $eventData = new EventData();
        $eventData->setDateTime("{$result['date']} {$result['time']}");
        $eventData->setTicketsAvailable($result['seats']);
        $eventData->setTicketPrice(NULL);
        $eventData->setName("A STROLL THROUGH HISTORY");
        $eventData->setArtistImage(NULL);
        $eventData->setHistoryTourImage('../images/history-image.png');
        $eventData->setTicketType(NULL);
        $eventData->setLocationName(NULL);
        $eventData->setLocationAddress(NULL);


        return $eventData;
    } catch (Exception $e) {
        echo $e->getMessage();
    }

}




}

?>