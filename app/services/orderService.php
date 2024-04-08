<?php


require __DIR__ . '/../repositories/orderRepository.php';


class OrderService
{
    private $orderRepository;

    public function __construct()
    {

        $this->orderRepository = new OrderRepository();
    }

    public function getAllOrders()
    {
        return $this->orderRepository->getAllOrders();
    }

    public function retrievePreviousOrder()
    {
        return $this->orderRepository->retrievePreviousOrder();
    }

    public function retrievePreviousOrderId()
    {
        return $this->orderRepository->retrievePreviousOrderId();
    }


    public function addOrder($id, $payment_status, $total_price)
    {
        return $this->orderRepository->addOrder($id, $payment_status, $total_price);
    }


    public function updateOrder($id, $paymentStatus)
    {

        return $this->orderRepository->updateOrder($id, $paymentStatus);
    }




}
?>