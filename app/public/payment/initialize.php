<?php


require_once __DIR__ . '/../../services/shoppingCartService.php';
require_once __DIR__ . '/../../services/userService.php';
 require_once __DIR__ . '/../../services/orderService.php';
 require_once __DIR__ . '/../../services/mailService.php';
 require_once __DIR__ .'/../../vendor/autoload.php';
 require_once __DIR__ .'/../../config/mollieConfig.php';





 $mollie = new \Mollie\Api\MollieApiClient();
 $mollie->setApiKey($mollieKey);

 $userService = new UserService();
 $shoppingCartService = new shoppingCartService();
$orderService = new OrderService();
$mailService = new MailService();




?>