<?php

require_once __DIR__ .'/../models/ticket.php';

require_once  __DIR__ . '/../repositories/orderItemRepository.php';


//class that handles updating and deleting various types of tickets
class TicketRepository extends Repository
{
   
    
    public function getPaidTicketById($id)
    {

        try {

            $stmt= $this->connection->prepare("SELECT * FROM tickets WHERE order_id IS NOT NULL AND id=:id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            return $row;
        } catch (PDOException $e) {
            echo $e;
        }

    }
   

    function getTicketById($id)
    {
        try {
            $query = "SELECT * FROM tickets WHERE id = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            return $row;
        } catch (PDOException $e) {
            echo $e;
        }
    }



function getTicketAndEventData($ticketId){
$shoppingCartRepository = new OrderItemRepository();
$eventDataTable = $shoppingCartRepository->getEventDataTable($ticketId);
if($eventDataTable["table"]=="dance_events"){
    $ticket = $this->getDanceEventTicketByTicketId($ticketId);
}

return $ticket;

}


    function getDanceEventTicketByTicketId($ticketId)
    {


        try {
            $query = "SELECT users.firstname, users.lastname, artists.name, dance_events.date, dance_events.start_time FROM tickets
                        LEFT JOIN users ON tickets.user_id = users.id                                               
                        LEFT JOIN event_artists ON tickets.dance_event_id = event_artists.event_id
                        LEFT JOIN artists ON event_artists.artist_id = artists.id
                        LEFT JOIN dance_events ON tickets.dance_event_id = dance_events.id
                        WHERE tickets.id = :id;";

            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id', $ticketId);            
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            return $row;
        } catch (PDOException $e) {
            echo $e;
        }
    }




function updateTicketQuantity($orderItemId, $ticketQuantity)
{
    $query = $this->connection->prepare("UPDATE tickets SET amount=:amount WHERE id=:id");
    $query->bindParam(":id", $orderItemId);
    $query->bindParam(":amount", $ticketQuantity);
    $query->execute();
}



function deleteTicket($id)
{
    try {
        $stmt = $this->connection->prepare("DELETE FROM tickets WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    } catch (PDOException $e) {
        echo $e;
    }
}



function updateTicketOrder($id, $order_id)
{
    $query = $this->connection->prepare("UPDATE tickets SET order_id=:order_id WHERE id=:id");
    $query->bindParam(":id", $id);
    $query->bindParam(":order_id", $order_id);
    $query->execute();


}





   

}

?>