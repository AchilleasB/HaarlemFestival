<?php


require_once __DIR__ . '/../../services/ticketService.php';


require_once __DIR__ . '/apiController.php';

class TicketController extends ApiController
{
    private $ticketService;

    public function __construct()
    {
        $this->ticketService = new TicketService();
    }
          


    public function getTicketById(){

         try {
             $this->sendHeaders();
            $ticket = NULL;

            if (!empty($_GET['id'])) {
                $ticketId= htmlspecialchars($_GET['id']);
                $ticket = $this->ticketService->getTicketById($ticketId);

            }

           echo Json_encode($ticket);
        } catch (InvalidArgumentException | Exception $e) {
            http_response_code(500); // sending bad request error to APi request if something goes wrong
            echo $e->getMessage();
        }

    }


    public function UpdateTicketQuantity()
    {
        try {

            $orderItemId = htmlspecialchars($_POST['id']);
            $ticketQuantity = htmlspecialchars($_POST['amount']);
           

            $this->ticketService->updateTicketQuantity($orderItemId, $ticketQuantity); 

        } catch (Exception $e) {
            http_response_code(500);
            echo $e;
        }
    }



    public function UpdateAvailableTicketsForDanceEvent()
    {
        try {

            $eventId = htmlspecialchars($_POST['event_id']);
            $availableTickets = htmlspecialchars($_POST['tickets_available']);

            $this->ticketService->updateAvailableDanceTicketsAtCheckout($eventId, $availableTickets); 

        } catch (Exception $e) {
            http_response_code(500);
            echo $e;
        }
    }


    public function UpdateAvailableTicketsForTourEvent()
    {
        try {

            $eventId = htmlspecialchars($_POST['event_id']);
            $ticketsToSubtract = htmlspecialchars($_POST['tickets_to_subtract']);

            $this->ticketService->updateAvailableTourTicketsAtCheckout($eventId, $ticketsToSubtract); 

        } catch (Exception $e) {
            http_response_code(500);
            echo $e;
        }
    }

    public function getTicketAndEventData(){

        try {
            $this->sendHeaders();

            if (!empty($_GET['id'])) {
                $id= htmlspecialchars($_GET['id']);
                $ticket = $this->ticketService->getTicketAndEventData($id);

            }

            echo Json_encode($ticket);
        } catch (InvalidArgumentException | Exception $e) {
            http_response_code(500); // sending bad request error to APi request if something goes wrong
            echo $e->getMessage();
        }
    }

}

?>
