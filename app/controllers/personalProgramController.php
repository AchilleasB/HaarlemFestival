<?php
require_once __DIR__ . '/../models/ticket.php';
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/userService.php';
require_once __DIR__ . '/../services/orderItemService.php';
require_once __DIR__ . '/../services/ticketService.php';
require_once __DIR__ . '/../services/yummy/reservationService.php';





class PersonalProgramController extends Controller
{
  private $userService;
  private $ticketService;
  private $orderItemService;
  private $user;
  private $currentOrderItems;
  private $products;
  private $orderTotal;
  private $orderVAT;
  private $paidTickets;


  function __construct()
  {
    $this->userService = new UserService();
    $this->ticketService = new TicketService();
    $this->orderItemService = new OrderItemService();
    $this->user = $this->userService->getUserByEmail($_SESSION['user_email']);
    $this->currentOrderItems = $this->getItems();
    $this->products = $this->orderItemService->getProducts($this->currentOrderItems);
    $this->orderTotal = $this->orderItemService->calculateOrderTotal($this->currentOrderItems, $this->products);
    $this->orderVAT = $this->orderItemService->calculateOrderVAT($this->currentOrderItems, $this->products);
    $this->paidTickets = $this->getPaidTickets();


  }


  public function index()
  {
    require __DIR__ . '/../views/personalProgram/index.php';

  }

  public function getItems()
  {
    if (!isset($_SESSION['order_items_data'])) {
      $_SESSION['order_items_data'] = [];
    }
    $this->setOrderItemsUserId();
    $orderItems = $this->ticketService->getUnpaidTickets($this->user->getId());
    $_SESSION['order_items_data']=$orderItems;

    return unserialize(serialize($orderItems));

  }


  public function setOrderItemsUserId(){

       $orderItems = unserialize(serialize($_SESSION['selected_items_to_purchase']));
       foreach($orderItems as $item){
        $this->ticketService->updateTicketUserId($item->getId(), $this->user->getId());
        if ($item->getReservationId() != NULL){
            $reservationService= new ReservationService();
            $reservationService->setUserIdToReservation($item->getReservationId(), $this->user->getId());
        }
      }
  }

  public function removeItem()
  {
    foreach ($_SESSION['order_items_data'] as $itemCount => $item) {
      if ($itemCount == $_POST['removeItem']) {
        $this->ticketService->deleteTicket($this->currentOrderItems[$itemCount]->getId());
        array_splice($_SESSION['order_items_data'], $itemCount, 1);
      }
    }
    header("location: /personalProgram");
  }




  public function updateTicketQuantity()
  {
    foreach ($_SESSION['order_items_data'] as $itemCount => $item) {
      if ($itemCount == $_POST['update']) {
        $ticket = $this->currentOrderItems[$itemCount];
        $newTicket = new Ticket();
        $newTicket->setId($ticket->getId());
        $newTicket->setAmount($_POST['quantity']);
        $newTicket->setCalcPrice($ticket->getCalcPrice());
        if ($ticket->getDanceEventId() !== null) {
          $newTicket->setDanceEventId($ticket->getDanceEventId());
        }
        if ($ticket->getHistoryTourId() !== null) {
          $newTicket->setHistoryTourId($ticket->getHistoryTourId());
        }
        if ($ticket->getReservationId() !== null) {
          $newTicket->setReservationId($ticket->getReservationId());
        }
        $newTicket->setUserId($ticket->getUserId());

        if ($this->products[$itemCount]['Event']->getTicketPrice()) {
          $ticketsPrice = $this->products[$itemCount]['Event']->getTicketPrice() * $newTicket->getAmount();
        } else {
          $ticketsPrice = $this->currentOrderItems[$itemCount]->getTicketPrice() * $newTicket->getAmount();
        }
        $this->ticketService->updateCalculatedPrice($ticket->getId(), $ticketsPrice);


        $_SESSION['order_items_data'][$itemCount] = $newTicket;
      }
    }
    header("location: /personalProgram");

  }


  public function addToCart()
  {
    if (!isset($_SESSION['selected_items_to_purchase'])) {
      $_SESSION['selected_items_to_purchase'] = [];
    }
    foreach ($_SESSION['order_items_data'] as $itemCount => $item) {
      if ($itemCount == $_POST['addToCart'])
        $_SESSION['selected_items_to_purchase'][count($_SESSION['selected_items_to_purchase'])] = $item;
    }
    header("location: /personalProgram");
  }



  public function addAllToCart()
  {

    $_SESSION['selected_items_to_purchase'] = $_SESSION['order_items_data'];

    header("location: /personalProgram");
  }

  public function getPaidTickets()
  {

      $paidTickets= $this->ticketService->getPaidTickets($this->user->getId());


    return $paidTickets;


  }






}

?>