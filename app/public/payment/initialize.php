<?php


require_once __DIR__ . '/../../services/shoppingCartService.php';
require_once __DIR__ . '/../../services/userService.php';
 require_once __DIR__ . '/../../services/orderService.php';
 require_once __DIR__ . '/../../services/invoiceService.php';
 require_once __DIR__ . '/../../services/mailService.php';
 require_once __DIR__ .'/../../vendor/autoload.php';
 require_once __DIR__ . '/../../models/danceTicket.php';




 $mollie = new \Mollie\Api\MollieApiClient();
 $mollie->setApiKey("test_j9xt6arbDFryMyzy94MRsT9VTH553s");

 $userService = new UserService();
 $shoppingCartService = new shoppingCartService();
$orderService = new OrderService();
$invoiceService = new InvoiceService();
$mailService = new MailService();




?>