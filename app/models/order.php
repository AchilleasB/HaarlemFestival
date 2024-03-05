<?php


class Order implements \JsonSerializable
{

    private int $id;
    private string $date_time;
    private string $payment_status;
    private int $user_id;

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
 * @return int
 */
public function getUserId(): int
{
    return $this->user_id;
}


public function setUserId(int $user_id)
{
    $this->user_id = $user_id;
}  


}
?>