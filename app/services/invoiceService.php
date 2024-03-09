<?php

require_once __DIR__ . '/../repositories/invoiceRepository.php';


class InvoiceService {

    private $billRepository;

    function __construct()
    {
        $this->billRepository = new InvoiceRepository();
    }


    public function getOne($id) {
        return $this->billRepository->getOne($id);
    }

    public function addBill($orderId, $totalVAT,$totalCost)
    {
        return $this->billRepository->addBill($orderId, $totalVAT,$totalCost);
    }


}

    ?>