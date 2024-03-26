<?php
// require_once __DIR__ . '/../models/danceTicket.php';
require_once __DIR__ . '/controller.php';
require_once __DIR__ . '/../services/userService.php';
require_once __DIR__ . '/../services/orderService.php';
require_once __DIR__ . '/../services/shoppingCartService.php';



class ShoppingCartController extends Controller
{
  private $shoppingCartService;
  private $userService;
  private $orderService;
  private $user;
  private $currentOrder;
  private $currentOrderItems;
  private $products;
  private $orderTotal;
  private $orderVAT;

  private $mollie;

  private $mollieProfile;


  function __construct()
  {

    require_once __DIR__ . '/../config/mollieConfig.php';
    $this->userService = new UserService();
    $this->orderService = new OrderService();
    $this->shoppingCartService = new ShoppingCartService();
    $this->user = $this->userService->getUserByEmail($_SESSION['user_email']);
    $this->currentOrderItems = $this->getItems();
    $this->products = $this->shoppingCartService->getProducts($this->currentOrderItems);
    $this->orderTotal = $this->shoppingCartService->calculateOrderTotal($this->currentOrderItems, $this->products);
    $this->orderVAT= $this->shoppingCartService->calculateOrderVAT($this->currentOrderItems, $this->products);
    $this->mollie = new \Mollie\Api\MollieApiClient();
    $this->mollie->setApiKey($mollieKey);
    $this->mollieProfile = $this->mollie->profiles->getCurrent();
    

  }


  public function index()
  {  
    require __DIR__ . '/../views/shoppingCart/index.php';

  }

  //retrieve only the tickets which are added by the user in the present session
  public function getItems()
  {

    $orderItems = unserialize(serialize($_SESSION['order_items_data']));

    return $orderItems;

  }


  public function removeItem()
  {
    foreach ($_SESSION['order_items_data'] as $itemCount => $item) {
      if ($itemCount == $_POST['removeItem'])
        array_splice($_SESSION['order_items_data'], $itemCount, 1);
    }
    header("location: /shoppingCart");
  }


  public function updateTicketQuantity()
  {
    foreach ($_SESSION['order_items_data'] as $itemCount => $item) {
      if ($itemCount == $_POST['update']){
        $ticket = $this->currentOrderItems[$itemCount];
         $newTicket = new DanceTicket();
         $newTicket->setId($ticket->getId());
        $newTicket->setAmount($_POST['quantity']);
        $newTicket->setEventId($ticket->getEventId());
        $newTicket->setUserId($ticket->getUserId());

        $_SESSION['order_items_data'][$itemCount] = $newTicket; 
    }
  }
  header("location: /shoppingCart");

  }



  public function selectPaymentMethod()
  {
    if ($this->orderTotal > 0) {
    require '../views/shoppingCart/paymentMethod.php';
  }
  else {
    header("location: /shoppingCart");
  }

  }

  public function confirmPurchase()
  {



    if (isset($_POST["paymentMethod"])) {
      if ($_POST["paymentMethod"] == "ideal") {
        $this->processIdealPayment($this->currentOrder);


      } else if ($_POST["paymentMethod"] == "visa" || $_POST["paymentMethod"] == "mastercard") {
        $this->processCreditcardPayment($this->currentOrder);
      }
    } else {

      require '../views/shoppingbasket/paymentMethod.php';
      echo "<p style='padding-left:12px;'>Select payment method</p> ";


    }
  }



  public function retrieveProtocol()
  {

    return isset($_SERVER['HTTPS']) && strcasecmp('off', $_SERVER['HTTPS']) !== 0 ? "https" : "http";
  }

  public function retrieveHostname()
  {
    return $_SERVER['HTTP_HOST'];

  }

  function processIdealPayment($order)
  {

    $this->mollieProfile->enableMethod('ideal');


    try {


      $orderId = $this->getCurrentOrderId();

      /*
       * Determine the url parts to these example files.
       */
      $protocol = $this->retrieveProtocol();
      $hostname = $this->retrieveHostname();

      $payment = $this->mollie->payments->create([
        "amount" => [
          "currency" => "EUR",
          "value" => sprintf("%.2f", (number_format($this->orderTotal, 2))) // You must send the correct number of decimals, thus we enforce the use of strings
        ],
        "method" => \Mollie\Api\Types\PaymentMethod::IDEAL,
        "description" => "Order #{$orderId}",
        "redirectUrl" => "{$protocol}://{$hostname}/payment/return.php?order_id={$orderId}",
        "webhookUrl" => "{$protocol}://a5eb-2001-1c04-330d-ed00-b938-d690-340c-2b12.ngrok-free.app",
        // "webhookUrl" => "{$protocol}://{$hostname}/payment/webhook.php",

        "metadata" => [
          "order_id" => $orderId,
          "user_email" => $this->user->getEmail(),
          "order_items" => $this->currentOrderItems,

        ],
      ]);

      $this->orderService->updateOrder($orderId, $payment->status);

      /*
       * Send the customer off to complete the payment.
       * This request should always be a GET, thus we enforce 303 http response code
       */
      header("Location: " . $payment->getCheckoutUrl(), true, 303);



    } catch (\Mollie\Api\Exceptions\ApiException $e) {
      echo "API call failed: " . htmlspecialchars($e->getMessage());
    }

  }



  public function processCreditcardPayment($order)
  {

    $this->mollieProfile->enableMethod('creditcard');


    try {
      $orderId = $this->getCurrentOrderId();

      /*
       * Determine the url parts to these example files.
       */
      $protocol = $this->retrieveProtocol();
      $hostname = $this->retrieveHostname();


      $payment = $this->mollie->payments->create([
        "amount" => [
          "currency" => "EUR",
          "value" => sprintf("%.2f", (number_format($this->orderTotal, 2))), // You must send the correct number of decimals, thus we enforce the use of strings
        ],
        "description" => "Order #{$orderId}",
        "redirectUrl" => "{$protocol}://{$hostname}/payment/return.php?order_id={$orderId}",
        "webhookUrl" => "{$protocol}://a5eb-2001-1c04-330d-ed00-b938-d690-340c-2b12.ngrok-free.app",

        "metadata" => [
          "order_id" => $orderId,
          "user_email" => $this->user->getEmail(),
          "order_items" => $this->currentOrderItems,
        ],
        "captureMode" => 'manual',
        "method" => "creditcard",
      ]);


      $this->orderService->updateOrder($orderId, $payment->status);

      /*
       * Send the customer off to complete the payment.
       */
      header("Location: " . $payment->getCheckoutUrl(), true, 303);
    } catch (\Mollie\Api\Exceptions\ApiException $e) {
      echo "API call failed: " . htmlspecialchars($e->getMessage());
    }


  }


  public function getCurrentOrderId()
  {
    $previousOrderId = $this->orderService->retrievePreviousOrderId();
    $currentOrderId = $previousOrderId += 1;
    return $currentOrderId;
  }


  public function displayOrderConfirmation()
  {

    $_SESSION['order_items_data'] = [];

    require_once __DIR__ . "/../views/shoppingCart/confirmedOrder.php";
  }


  public function displayOrderCancellation()
  {

    require_once __DIR__ . "/../views/shoppingCart/canceledOrder.php";


  }
}

?>