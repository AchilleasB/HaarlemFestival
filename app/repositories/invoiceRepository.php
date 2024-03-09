<?php

require_once __DIR__ . '/repository.php';

require_once __DIR__ . '/../models/invoice.php';


class InvoiceRepository extends Repository
{


    function getOne($id)
    {
        try {
            $query = "SELECT * FROM invoices WHERE id = :id";
            $stmt = $this->connection->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $row = $stmt->fetch();
            $invoice = $this->convertDbRowToBillInstance($row);

            return $invoice;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    function convertDbRowToBillInstance($row) {
        try {
            if (!is_null($row)) {
            $bill = new Invoice();
            $bill->setId($row['id']);
            $bill->setIssueDate($row['issue_date']);
            $bill->setTotalVAT($row['total_VAT']);
            $bill->setTotalCost($row['total_cost']);
            return $bill;
    
} else {
    return NULL;
}
} catch (Exception $exp) {

echo $exp;
}}




public function addBill($orderId, $totalVAT,$totalCost)
{
    
    $stmt = $this->connection->prepare("INSERT INTO invoices(issue_date, order_id, total_VAT, total_cost)VALUES(:issue_date, :order_id, :total_VAT, :total_cost)");
    $now = date("Y-m-d");
    $stmt->bindParam(':issue_date', $now);
    $stmt->bindParam(':order_id', $orderId);
    $stmt->bindParam(':total_VAT', $totalVAT);
    $stmt->bindParam(':total_cost', $totalCost);

    $stmt->execute();

    $billId= $this->connection->lastInsertId();

    return $this->getOne($billId);


}

}


    ?>