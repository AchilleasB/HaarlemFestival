<?php

require_once __DIR__ . '/../models/ticket.php';

require_once __DIR__ . '/../repositories/orderItemRepository.php';

require_once __DIR__ . '/../repositories/yummy/reservationRepository.php';



//class that handles updating and deleting various types of tickets
class TicketRepository extends Repository
{


    public function getPaidTickets($userId)
    {

        try {

            $stmt = $this->connection->prepare("SELECT * FROM tickets WHERE order_id IS NOT NULL and user_id=:user_id");
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Ticket');
            $tickets = $stmt->fetchAll();

            return $tickets;
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getLine();
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
            echo $e->getMessage() . $e->getLine();
        }

    }



    function getTicketAndEventData($ticketId)
    {
        $shoppingCartRepository = new OrderItemRepository();
        $eventDataTable = $shoppingCartRepository->getEventDataTable($ticketId);
        if ($eventDataTable["table"] == "dance_events") {
            $ticket = $this->getDanceEventTicketByTicketId($ticketId);
        }
        if ($eventDataTable["table"] == "history_tours") {
            $ticket = $this->getTourEventTicketByTicketId($ticketId);
        }
        if ($eventDataTable["table"] == "reservations") {
            $ticket = $this->getYummyEventTicketByTicketId($ticketId);
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
            echo $e->getMessage() . $e->getLine();
        }

    }


    function getTourEventTicketByTicketId($ticketId)
    {
        try {
            $query = "SELECT users.firstname, users.lastname, history_tours.date, DATE_FORMAT(history_tours.time,  '%H:%i') AS start_time  FROM tickets
            LEFT JOIN users ON tickets.user_id = users.id  
            LEFT JOIN history_tours ON tickets.history_tour_id = history_tours.id                                             
            WHERE tickets.id = :id;";

            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id', $ticketId);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            $row['name'] = "A STROLL THROUGH HISTORY";
            return $row;
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getLine();
        }

    }


    function getYummyEventTicketByTicketId($ticketId)
    {
        try {
            $query = "SELECT users.firstname, users.lastname, restaurants.name, DATE_FORMAT(sessions.start_date,  '%d-%m-%Y' ) AS date, DATE_FORMAT(sessions.start_date,  '%H:%i' ) AS start_time  FROM tickets
            LEFT JOIN users ON tickets.user_id = users.id  
            LEFT JOIN reservations ON tickets.reservation_id = reservations.id  
            LEFT JOIN restaurants ON reservations.restaurant_id = restaurants.id
            LEFT JOIN restaurants_sessions ON reservations.session_id = restaurants_sessions.session_id
            LEFT JOIN haarlem_festival.sessions ON restaurants_sessions.session_id = sessions.id                                         
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
        try {
            $query = $this->connection->prepare("UPDATE tickets SET amount=:amount WHERE id=:id");
            $query->bindParam(":id", $orderItemId);
            $query->bindParam(":amount", $ticketQuantity);
            $query->execute();

        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getLine();
        }

    }

    function updateCalculatedPrice($id, $calc_price)
    {

        try {
            $query = $this->connection->prepare("UPDATE tickets SET calc_price=:calc_price WHERE id=:id");
            $query->bindParam(":id", $id);
            $query->bindParam(":calc_price", $calc_price);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getLine();
        }

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
        try {
            $reservationRepository = new ReservationRepository();
            $reservationId = $reservationRepository->getReservationIdByTicketId($id);
            if ($reservationId != NULL) {
                $reservationRepository->activateReservation($reservationId);
            }

            $query = $this->connection->prepare("UPDATE tickets SET order_id=:order_id WHERE id=:id");
            $query->bindParam(":id", $id);
            $query->bindParam(":order_id", $order_id);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage() . $e->getLine();
        }



    }







}

?>