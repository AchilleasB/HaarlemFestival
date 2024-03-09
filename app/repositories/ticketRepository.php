<?php

require_once __DIR__ . '/repository.php';

require_once __DIR__ .'/../models/danceTicket.php';


//class that handles updating and deleting various types of tickets
class TicketRepository extends Repository
{
   public function getAllDanceTickets()
    {

        try {

            $stmt = $this->connection->prepare("SELECT * FROM dance_tickets");

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'DanceTicket');
            $danceTickets = $stmt->fetchAll();

            return $danceTickets;

        } catch (PDOException $e) {
            echo $e;
        }
    }
    
    public function retrievePreviousDanceTicket()
    {
        try {

            $danceTickets = $this->getAllDanceTickets();
            $previousDanceTicket= end($danceTickets);
            return $previousDanceTicket;

        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function retrievePreviousDanceTicketId()
    {
        $previousDanceTicket = $this->retrievePreviousDanceTicket();
        if ($previousDanceTicket  != NULL) {
            $previousDanceTicketId = $previousDanceTicket->getId();
        } else {
            $previousDanceTicketId = 0;
        }
        return $previousDanceTicketId;
    }
   
   

    function getDanceTicketById($id)
    {
        try {
            $query = "SELECT * FROM dance_tickets WHERE id = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            $product = $this->convertDbRowToDanceTicketInstance($row);

            return $product;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    
    function convertDbRowToDanceTicketInstance($row) {
        try {
            if (!is_null($row)) {
                $orderItem = new DanceTicket();
                $orderItem->setId($row['id']);
                $orderItem->setAmount($row['amount']);
                $orderItem->setEventId($row['event_id']);
                $orderItem->setUserId($row['user_id']);
                return $orderItem;
    
} else {
    return NULL;
}
} catch (Exception $exp) {

echo $exp;
}}



function updateDanceTicketQuantity($orderItemId, $ticketQuantity)
{
    $query = $this->connection->prepare("UPDATE dance_tickets SET amount=:amount WHERE id=:id");
    $query->bindParam(":id", $orderItemId);
    $query->bindParam(":amount", $ticketQuantity);
    $query->execute();
}



function deleteDanceTicket($id)
{
    try {
        $stmt = $this->connection->prepare("DELETE FROM dance_tickets WHERE id=:id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

    } catch (PDOException $e) {
        echo $e;
    }
}



function updateAvailableTicketsForDanceEvent($orderItemId, $availableTickets)
{
    $query = $this->connection->prepare("UPDATE dance_events SET tickets_available=:tickets_available WHERE id=:id");
    $query->bindParam(":id", $orderItemId);
    $query->bindParam(":tickets_available", $availableTickets);
    $query->execute();
}




   

}

?>