<?php

require_once __DIR__ . '/../repositories/orderItemRepository.php';
require_once __DIR__ . '/../services/userService.php';
require_once __DIR__ . '/../vendor/autoload.php';

use Dompdf\Dompdf;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;



class OrderItemService
{
    private $ShoppingCartRepository;


    public function __construct()
    {

        $this->ShoppingCartRepository = new OrderItemRepository();

    }

    public function getCurrentOrderItems($order_id)
    {
        return $this->ShoppingCartRepository->getCurrentOrderItems($order_id);
    }


    public function getProducts($orderItems, $itemIsStdClass = false)
    {
        $eventsData = [];

        foreach ($orderItems as $orderItem => $i) {

            if (!$itemIsStdClass) {
                $event = $this->ShoppingCartRepository->getProductData($i->getId());
            } else {
                $event = $this->ShoppingCartRepository->getProductData($i->id);
            }
            $eventsData[$orderItem]['Event'] = $event;

        }

        return $eventsData;
    }


    function getProductData($ticketId)
    {

        return $this->ShoppingCartRepository->getProductData($ticketId);
    }

    public function getDanceEventData($eventId)
    {

        return $this->ShoppingCartRepository->getDanceEventData($eventId);

    }



    function calculateOrderTotal($orderItems, $productData)
    {
        $orderTotal = 0;

        foreach ($orderItems as $itemCount => $orderItem) {

            if ($productData[$itemCount]['Event']->getTicketPrice()) {
                $productPrice = $productData[$itemCount]['Event']->getTicketPrice();
            } else {
                $productPrice = $orderItems[$itemCount]->getTicketPrice($orderItems[$itemCount]->getAmount());
            }
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

        foreach ($orderItems as $itemCount => $orderItem) {


            if ($productData[$itemCount]['Event']->getTicketPrice()) {
                $productPrice = $productData[$itemCount]['Event']->getTicketPrice();
            } else {
                $productPrice = $orderItems[$itemCount]->getTicketPrice($orderItems[$itemCount]->getAmount());
            }
            $productQuantity = $orderItem->getAmount();
            $productTotalVAT = $productPrice * $productQuantity * $productVAT;
            $orderVAT += $productTotalVAT;
        }


        return $orderVAT;
    }




    public function createPdf($html, $pdfPath)
    {

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
        require ($invoiceHtmlTemplate);
        $html = ob_get_contents();
        ob_get_clean();
        $pdfPath = __DIR__ . "/../public/invoices/InvoiceNr" . $order->getId() . ".pdf";

        $this->createPdf($html, $pdfPath);
    }



    public function createTicketPdf($user, $orderItems, $products)
    {

        $tickets = [];
        $ticketsCount = count(glob(__DIR__ . "/../public/tickets/" . "*.{pdf}"));
        foreach ($products as $item => $i) {
            $ticket = $orderItems[$item];
            $ticketAmount = $orderItems[$item]->amount;
            $event = $products[$item]['Event'];
            $eventName = $event->getName();
            $dateTime = $event->getDateTime();
            $ticketCount = $ticketsCount++;
            $qrCodeId = bin2hex(random_bytes(50));
            $qrData = $this->generateQrCode($ticket->id);
            $ticketHtmlTemplate = __DIR__ . "/../views/shoppingcart/ticket.php";

            ob_start();
            require ($ticketHtmlTemplate);
            $html = ob_get_contents();
            ob_get_clean();

            if ($ticketAmount > 1) {
                for ($i = 0; $i < $ticketAmount; $i++) {
                    $pdfPath = __DIR__ . "/../public/tickets/ticket" . $ticketsCount++ . ".pdf";
                    $this->createPdf($html, $pdfPath);
                    $tickets[count($tickets)] = $pdfPath;
                }
            } else {
                $pdfPath = __DIR__ . "/../public/tickets/ticket" . $ticketCount++ . ".pdf";
                $this->createPdf($html, $pdfPath);
                $tickets[count($tickets)] = $pdfPath;
            }

        }



        return $tickets;


    }




    public function generateQrCode($ticketId)
    {
        $qr = QrCode::create("TicketId:" . $ticketId);
        $writer = new PngWriter();
        $output = $writer->write($qr);
        $file = __DIR__ . "/../public/tickets/qr/qr" . $ticketId . ".png";
        $output->saveToFile($file);
        $qrData = $output->getDataUri();

        return $qrData;

    }


}
?>