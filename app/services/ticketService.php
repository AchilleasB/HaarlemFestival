<?php

require_once  __DIR__ . '/../repositories/ticketRepository.php';



class TicketService
{
    private $ticketRepository;

    public function __construct()
    {

        $this->ticketRepository = new TicketRepository();
    }

    
    public function getAllDanceTickets()
    {
        return $this->ticketRepository->getAllDanceTickets();
    }

    public function retrievePreviousDanceTicket()
    {
        return $this->ticketRepository->retrievePreviousDanceTicket();
    }

    public function retrievePreviousDanceTicketId()
    {
        return $this->ticketRepository->retrievePreviousDanceTicketId();
    }

    
    public function getDanceTicketById($id)
    {
        return $this->ticketRepository->getDanceTicketById($id);
    }

    public function updateDanceTicketQuantity($orderItemId, $productQuantity)
    {
        return $this->ticketRepository->updateDanceTicketQuantity($orderItemId, $productQuantity);
    }
 
    public function deleteDanceTicket($id) {     
    
     return $this->ticketRepository->deleteDanceTicket($id);   
}


function updateAvailableTicketsForDanceEvent($orderItemId, $availableTickets)
{
    return $this->ticketRepository->updateAvailableTicketsForDanceEvent($orderItemId, $availableTickets);

}


}
?>