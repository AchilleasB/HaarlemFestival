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
    else if($result['reservation_id'] != NULL){
        $eventTableData = [ "table" => "reservations", "event_id" => $result['reservation_id']];
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
    if ($eventDataTable["table"] == "reservations"){
        $res = $this->getYummyEventData($eventDataTable["event_id"]);
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



function getYummyEventData($eventId)
{
    try {
        $stmt = $this->connection->prepare("SELECT reservations.number_of_people, restaurants.name, restaurants.location, restaurants.number_of_seats, sessions.start_date
                                                FROM reservations
                                                LEFT JOIN restaurants ON reservations.restaurant_id = restaurants.id
                                                LEFT JOIN restaurants_sessions ON reservations.session_id = restaurants_sessions.session_id
                                                LEFT JOIN haarlem_festival.sessions ON restaurants_sessions.session_id = sessions.id
                                                WHERE reservations.id = :id;"

                                                );
        $stmt->bindParam(':id', $eventId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $eventData = $this->createYummyEventDataInstance($result);
        
        
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
        $eventData->setYummyEventImage(NULL);
        $eventData->setTicketType($result['type']);
        $eventData->setLocationName($result['name']);
        $eventData->setLocationAddress($result['address']);


        return $eventData;
    } catch (PDOException $e) {
        echo $e->getMessage() . $e->getLine();
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
        $eventData->setYummyEventImage(NULL);
        $eventData->setTicketType(NULL);
        $eventData->setLocationName(NULL);
        $eventData->setLocationAddress(NULL);


        return $eventData;
    } catch (PDOException $e) {
        echo $e->getMessage() . $e->getLine();
    }


}


private function createYummyEventDataInstance($result): EventData
{ 
    try{

        $eventData = new EventData();
        $eventData->setDateTime("{$result['start_date']}");
        $eventData->setTicketsAvailable($result['number_of_seats']);
        $eventData->setTicketPrice(10.00);
        $eventData->setName($result['name']);
        $eventData->setArtistImage(NULL);
        $eventData->setHistoryTourImage(NULL);
        $eventData->setYummyEventImage('../images/yummy.png');
        $eventData->setTicketType(NULL);
        $eventData->setLocationName($result['location']);
        $eventData->setLocationAddress(NULL);


        return $eventData;
    } catch (PDOException $e) {
        echo $e->getMessage() . $e->getLine();
    }


}




}

?>