<?php

 require __DIR__ .'/initialize.php';



/*
 * The order status is normally updated by the webhook.
 * In case the webhook did not yet arrive, we can poll the API synchronously.
 */

   $paymentForUserOrder =[];
   foreach ($mollie->payments->page() as $payment) {
     if ($payment->metadata->order_id == $_GET["order_id"]){
       array_push($paymentForUserOrder, $payment);  
  
     }
   
  }


  $currentPayment = reset($paymentForUserOrder);
  $userEmail = $currentPayment->metadata->user_email;
  

 if ($currentPayment->status=="paid" ||  $currentPayment->status=="authorized"){

  //create new order then create invoice, send invoice and tickets
  $orderId = $currentPayment->metadata->order_id; 
  $orderTotal = $currentPayment->amount->value;
  $orderPaymentStatus='paid';
  $user =  $userService->getUserByEmail($userEmail);
  $orderUserId = $user->getId();
  $order = $orderService->addOrder($orderId, $orderPaymentStatus, $orderTotal);


  $orderItems = $currentPayment->metadata->order_items;
  $products = $shoppingCartService->getProducts($orderItems, true);
  $shoppingCartService->createInvoicePdf($user, $orderItems, $products, $order);
  $mailService->sendInvoiceMail($userEmail, __DIR__ . "/../invoices/InvoiceNr". $order->getId() . ".pdf");
  $tickets = $shoppingCartService->createTicketPdf($user, $orderItems, $products);
  $mailService->sendTicketsMail($userEmail, $tickets);

  foreach($orderItems as $item){
   
    $ticketService->updateTicketOrder($item->id, $order->getId());
  } 

  
header('Location: /shoppingCart/displayOrderConfirmation');

 } 


else { 

  header('Location: /shoppingCart/displayOrderCancellation');



} ?>