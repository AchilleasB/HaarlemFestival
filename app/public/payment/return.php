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
  $order = new Order();
  $orderId = $currentPayment->metadata->order_id; 
  $orderPaymentStatus='paid';
  $user =  $userService->getUserByEmail($userEmail);
  $orderUserId = $user->getId();
  $orderService->addOrder($orderId, $orderPaymentStatus,$orderUserId);


  $orderItems = $currentPayment->metadata->order_items;
  $products = $shoppingCartService->getProducts($orderItems, true);
  $orderTotal = $currentPayment->amount->value;
  $orderVAT = $currentPayment->metadata->order_vat;
  $invoice = $invoiceService->addBill($_GET["order_id"], $orderVAT, $orderTotal);
  $shoppingCartService->createInvoicePdf($user, $orderItems, $products, $invoice);
  $mailService->sendInvoiceMail($userEmail, __DIR__ . "/../invoices/InvoiceNr". $invoice->getId() . ".pdf");
  $tickets = $shoppingCartService->createTicketPdf($user, $orderItems, $products);
  $mailService->sendTicketsMail($userEmail, $tickets);



header('Location: /shoppingCart/displayOrderConfirmation');

 } 


else { 

  header('Location: /shoppingCart/displayOrderCancellation');



} ?>