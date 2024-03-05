<?php


class Invoice implements \JsonSerializable
{
    private int $id;
    private string $issue_date;
    private int $order_id;
    private float $total_VAT;
    private float $total_cost;

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }

  /**
     * @return int
     */

     public function getId(): int
     {
         return $this->id;
     }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

 
       /**
     * @return string
     */

     public function getIssueDate(): string
     {
         return $this->issue_date;
     }

     public function setIssueDate(string $issue_date): void
     {
         $this->issue_date = $issue_date;
     }
 

      /**
     * @return int
     */
 
     public function getOrderId(): int
     {
         return $this->order_id;
     }
 


     public function setOrderId(int $order_id): void
     {
         $this->order_id = $order_id;
     }
 

   /**
     * @return float
     */
 
     public function getTotalVAT(): float
     {
         return $this->total_VAT;
     }


     public function setTotalVAT(float $total_VAT): void
     {
         $this->total_VAT=$total_VAT;
     }
 
 

   /**
     * @return float
     */
 
     public function getTotalCost(): float
     {
         return $this->total_cost;
     }
 
     public function setTotalCost(float $total_cost): void
     {
         $this->total_cost=$total_cost;
     }
 
 

}

?>