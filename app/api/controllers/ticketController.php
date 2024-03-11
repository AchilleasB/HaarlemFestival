<?php
require __DIR__ . '/../../services/ticketService.php';
require __DIR__ . '/apiController.php';

class TicketController extends ApiController
{
    private $ticketService;

    public function __construct()
    {
        $this->ticketService = new TicketService();
    }
          


    public function getDanceTicketById(){

        try {
            $this->sendHeaders();
            $ticket = NULL;

            if (!empty($_GET['id'])) {
                $ticketId= htmlspecialchars($_GET['id']);
                $ticket = $this->ticketService->getDanceTicketById($ticketId);

            }

            echo Json_encode($ticket);
        } catch (InvalidArgumentException | Exception $e) {
            http_response_code(500); // sending bad request error to APi request if something goes wrong
            echo $e->getMessage();
        }

    }


    public function UpdateDanceTicketQuantity()
    {
        try {

            $orderItemId = htmlspecialchars($_POST['id']);
            $ticketQuantity = htmlspecialchars($_POST['amount']);
           

            $this->ticketService->updateDanceTicketQuantity($orderItemId, $ticketQuantity); 

        } catch (Exception $e) {
            http_response_code(500);
            echo $e;
        }
    }


    public function deleteDanceTicket()
    {  
        try {

            $ticketId = $_GET['id'];
            $this->ticketService->deleteDanceTicket($ticketId);
             
            echo Json_encode('true');
            
        } catch (Exception $e) {
            http_response_code(500); // sending bad request error to APi request if something goes wrong
            echo $e->getMessage();
        }

    }


    public function UpdateAvailableTicketsForDanceEvent()
    {
        try {

            $eventId = htmlspecialchars($_POST['event_id']);
            $availableTickets = htmlspecialchars($_POST['tickets_available']);

            $this->ticketService->updateAvailableTicketsForDanceEvent($eventId, $availableTickets); 

        } catch (Exception $e) {
            http_response_code(500);
            echo $e;
        }
    }



    public function getTicketByEvent(){

        try {
            $this->sendHeaders();

            if (!empty($_GET['name'] && !empty($_GET['event']))) {
                $customer_name= htmlspecialchars($_GET['name']);
                $event= htmlspecialchars($_GET['event']);
                $ticket = $this->ticketService->getTicketByEvent($customer_name, $event);

            }

            echo Json_encode($ticket);
        } catch (InvalidArgumentException | Exception $e) {
            http_response_code(500); // sending bad request error to APi request if something goes wrong
            echo $e->getMessage();
        }
    }

}

?>
