<?php

require_once __DIR__ . '/repository.php';

require_once __DIR__ . '/../models/order.php';


class OrderRepository extends Repository
{

    function getOne($id)
{
    try {
        $query = "SELECT * FROM orders WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $row = $stmt->fetch();
        $invoice = $this->convertDbRowToOrderInstance($row);

        return $invoice;
    } catch (PDOException $e) {
        echo $e;
    }
}



    public function getAllOrders()
    {

        try {

            $stmt = $this->connection->prepare("SELECT * FROM orders");

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Order');
            $order = $stmt->fetchAll();

            return $order;

        } catch (PDOException $e) {
            echo $e;
        }
    }
    
    public function retrievePreviousOrder()
    {
        try {

            $orders = $this->getAllOrders();
            $previousOrder=end($orders);
            return $previousOrder;

        } catch (PDOException $e) {
            echo $e;
        }
    }


    public function retrievePreviousOrderId()
    {
        $previousOrder = $this->retrievePreviousOrder();
        if ($previousOrder  != NULL) {
            $previousOrderId = $previousOrder->getId();
        } else {
            $previousOrderId = 0;
        }
        return $previousOrderId;
    }
   

    
    function convertDbRowToOrderInstance($row) {
        try {
                $order = new Order();
                $order->setId($row['id']);
                $order->setDateTime($row['date_time']);
                $order->setPaymentStatus($row['payment_status']);
                $order->setTotalPrice($row['total_price']);

                return $order;
    

} catch (Exception $exp) {

echo $exp;
}}




public function addOrder($id, $payment_status, $total_price)
{
    $stmt = $this->connection->prepare("INSERT INTO orders(id, date_time, payment_status, total_price)VALUES(:id, :date_time, :payment_status, :total_price)");
    $now = date("Y-m-d H:i:s"); 
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':date_time', $now);
    $stmt->bindParam(':payment_status', $payment_status);
    $stmt->bindParam(':total_price', $total_price);

    $stmt->execute();

    $orderId= $this->connection->lastInsertId();

    return $this->getOne($orderId);

}





function updateOrder($orderId, $paymentStatus)
{
    $query = $this->connection->prepare("UPDATE orders SET payment_status=:payment_status WHERE id=:id");
    $query->bindParam(":id", $orderId);
    $query->bindParam(":payment_status", $paymentStatus);
    $query->execute();
}




   

}

?>