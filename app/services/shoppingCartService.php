<?php

require_once __DIR__ . '/../repositories/shoppingCartRepository.php';
require_once __DIR__ . '/../services/userService.php';
require_once __DIR__ .  '/../vendor/autoload.php';

use Dompdf\Dompdf; 
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;



class ShoppingCartService
{
    private $ShoppingCartRepository;
    

    public function __construct()
    {

        $this->ShoppingCartRepository = new ShoppingCartRepository();

    }

    public function getCurrentOrderItems($order_id) {
        return $this->ShoppingCartRepository->getCurrentOrderItems($order_id);
    }


        public function getProducts($orderItems, $itemIsStdClass=false) {
            $eventsData=[];
            
            foreach($orderItems as $orderItem=>$i){
    
                if (!$itemIsStdClass){
                $event = $this->ShoppingCartRepository->getProductData($i->getEventId());}
                else {$event = $this->ShoppingCartRepository->getProductData($i->event_id);}
                $eventsData[$orderItem]['Event'] = $event;
    
            }
    
            return $eventsData;
        }




        public function getProductData($eventId){

            return $this->ShoppingCartRepository->getProductData($eventId);
        
        }
        
    
    

    function calculateOrderTotal($orderItems, $productData)
    {            
        $orderTotal = 0;
    
        foreach ($orderItems as $itemCount=>$orderItem) {

            $productPrice = $productData[$itemCount]['Event']->getTicketPrice();
            $productQuantity = $orderItem->getAmount();
            $productTotalPrice = $productPrice * $productQuantity;
            $orderTotal += $productTotalPrice;
        }


        return $orderTotal;
    }


    function calculateOrderVAT($orderItems, $productData)
    {
        $productVAT = 0.21;
        $orderVAT = 0;
    
        foreach ($orderItems as $itemCount=>$orderItem) {

            $productPrice = $productData[$itemCount]['Event']->getTicketPrice();
            $productQuantity = $orderItem->getAmount();
            $productTotalVAT = $productPrice * $productQuantity * $productVAT;
            $orderVAT += $productTotalVAT;
        }


        return $orderVAT;
    }


    

public function createPdf($html, $pdfPath){

    $dompdf = new Dompdf();
    $dompdf->load_html($html);
    $dompdf->render();
    $output = $dompdf->output();
    file_put_contents($pdfPath, $output);
    
    }
    
    public function createInvoicePdf($user, $orderItems, $products, $order)
    {
    
        $invoiceHtmlTemplate = __DIR__ . "/../views/shoppingcart/invoice.php";
        ob_start();
        require($invoiceHtmlTemplate);
        $html = ob_get_contents();
        ob_get_clean();
        $pdfPath = __DIR__ . "/../public/invoices/InvoiceNr" . $order->getId() .".pdf";
        
        $this->createPdf($html, $pdfPath);
        }
        
    
    
    public  function createTicketPdf($user, $orderItems, $products){
        
        $tickets = [];
        $ticketsCount = count(glob(__DIR__ ."/../public/tickets/" ."*" ));
        foreach($products as $item=>$i){
        $ticket = $orderItems[$item];
        $event = $products[$item]['Event'];
        $eventName = $event->getName();
        $ticketType = $products[$item]['Event']->getTicketType();
        $dateTime = $event->getDateTime();
        $ticketId = $ticketsCount++;
        $qrCodeId = bin2hex(random_bytes(50));
        $qrData = $this->generateQrCode($user,$qrCodeId, $event);
        $ticketHtmlTemplate = __DIR__ . "/../views/shoppingcart/ticket.php";
        
        ob_start();
        require($ticketHtmlTemplate);
        $html = ob_get_contents();
        ob_get_clean();
        $pdfPath = __DIR__ . "/../public/tickets/ticket". $ticketId . ".pdf";
        $this->createPdf($html, $pdfPath);
        $tickets[count($tickets)] = $pdfPath;
        }
    
        return $tickets;
    
    
    }
    
    
    
    
    public function generateQrCode($user, $ticketId, $eventData){
    $name = $user->getFirstname() ." ". $user->getLastname();
    $qr = QrCode::create("Name:". $name ."
    Event:". $eventData->getName() . "
    Datetime:" . $eventData->getDateTime() ."");
    $writer = new PngWriter();
    $output = $writer->write($qr);
    $file = __DIR__ . "/../public/tickets/qr/qr" . $ticketId . ".png";
    $output->saveToFile($file);
    $qrData = $output->getDataUri();
    
    return $qrData; 
    
    }
    

}
?>