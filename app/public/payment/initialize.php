<?php


require_once __DIR__ . '/../../services/orderItemService.php';
require_once __DIR__ . '/../../services/userService.php';
require_once __DIR__ . '/../../services/ticketService.php';
 require_once __DIR__ . '/../../services/orderService.php';
 require_once __DIR__ . '/../../services/mailService.php';
 require_once __DIR__ .'/../../vendor/autoload.php';
 require_once __DIR__ .'/../../config/mollieConfig.php';


 $mollie = new \Mollie\Api\MollieApiClient();
 $mollie->setApiKey($mollieKey);

 $userService = new UserService();
 $ticketService = new TicketService();
 $shoppingCartService = new OrderItemService();
$orderService = new OrderService();
$mailService = new MailService();




?>