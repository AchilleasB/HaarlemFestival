<?php

require_once  __DIR__ . '/../repositories/danceRepository.php';

require_once  __DIR__ . '/../repositories/historyTourRepository.php';

require_once  __DIR__ . '/../repositories/ticketRepository.php';





class TicketService
{
    private $ticketRepository;

    public function __construct()
    {

        $this->ticketRepository = new TicketRepository();
    }



    public function getPaidTicketById($id)
    {
        return $this->ticketRepository->getPaidTicketById($id);
    }


    
    public function getTicketById($id)
    {
        return $this->ticketRepository->getTicketById($id);
    }


   
    public function getTicketAndEventData($ticketId){
        return $this->ticketRepository->getTicketAndEventData($ticketId);
    }

    public function updateTicketQuantity($orderItemId, $productQuantity)
    {
        return $this->ticketRepository->updateTicketQuantity($orderItemId, $productQuantity);
    }

    //Function used to update available tickets at checkout
    //Allows users to be simultaneously updated with available dance tickets
    function updateAvailableDanceTicketsAtCheckout($id, $newTicketsAvailable){
        $danceRepository=new DanceRepository();
        $danceRepository->updateTicketsAmount($id, $newTicketsAvailable);
    }


     //Function used to update available tickets at checkout
    //Allows users to be simultaneously updated with available history tour tickets
    function updateAvailableTourTicketsAtCheckout($id, $ticketAmountSubtracted){
        $historyTourRepository=new HistoryTourRepository();
        $historyTourRepository->updateSeats($id, $ticketAmountSubtracted);
    }

    public function updateCalculatedPrice($id, $calc_price){

      $this->ticketRepository->updateCalculatedPrice($id, $calc_price);
    }
 
    public function deleteTicket($id) {     
    
     return $this->ticketRepository->deleteTicket($id);   
}


function updateTicketOrder($id, $order_id)
{

    return $this->ticketRepository->updateTicketOrder($id, $order_id);

}



}
?>