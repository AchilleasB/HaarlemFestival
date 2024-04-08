<?php
require __DIR__ . '/../../services/orderService.php';
require __DIR__ . '/apiController.php';

class OrderController extends ApiController
{
    private $orderService;

    public function __construct()
    {
        $this->orderService = new OrderService();
    }



    public function getAllOrders()
    {

        try {
            $this->sendHeaders();
            $orders = NULL;
            $orders = $this->orderService->getAllOrders();
            echo Json_encode($orders);
        } catch (InvalidArgumentException | Exception $e) {
            http_response_code(500); // sending bad request error to APi request if something goes wrong
            echo $e->getMessage();
        }

    }


}

?>