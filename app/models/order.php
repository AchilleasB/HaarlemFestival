<?php


class Order implements \JsonSerializable
{

    private int $id;
    private string $date_time;
    private string $payment_status;
    private float $total_price;

    public function jsonSerialize(): mixed
    {
        return get_object_vars($this);
    }


    /**
 * @return int
 */
public function getId(): string
{
    return $this->id;
}


public function setId(int $id)
{
    $this->id = $id;
}  



/**
 * @return string
 */
public function getDateTime(): string
{
    return $this->date_time;
}



public function setDateTime(string $value )
{
    $phpdate = strtotime( $value );
    $dateTimeInfo = date( 'd-m-Y H:i', $phpdate );
    $this->date_time = $dateTimeInfo;
}  

/**
 * @return string
 */
public function getPaymentStatus(): string
{
    return $this->payment_status;
}


public function setPaymentStatus(string $payment_status)
{
    $this->payment_status = $payment_status;
}  


/**
 * @return float
 */
public function getTotalPrice(): float
{
    return $this->total_price;
}


public function setTotalPrice(float $total_price)
{
    $this->total_price = $total_price;
}  


}
?>