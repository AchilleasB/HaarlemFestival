<?php

//payment configuration after deployment

require __DIR__ .'/initialize.php';


try {
   
    $paymentForUserOrder =[];
    foreach ($mollie->payments->page() as $payment) {
      if ($payment->metadata->order_id == $_GET["order_id"]){
        array_push($paymentForUserOrder, $payment);  
   
      }
    
   }
 
 
   $currentPayment = reset($paymentForUserOrder);
   $orderService->updateOrder($payment->metadata->order_id, $currentPayment->status);


    if ($payment->isPaid()) {
        /*
         * The payment is paid and isn't refunded or charged back.
         * At this point you'd probably want to start the process of delivering the product to the customer.
         */
    }  elseif ($payment->isFailed()) {
        /*
         * The payment has failed.
         */
    } elseif ($payment->isExpired()) {
        /*
         * The payment is expired.
         */
    } 
} catch (\Mollie\Api\Exceptions\ApiException $e) {
    echo "API call failed: " . htmlspecialchars($e->getMessage());
}
