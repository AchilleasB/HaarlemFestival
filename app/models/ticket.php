<?php
//require_once __DIR__ . '/../vendor/autoload.php';
//use Ramsey\Uuid\Uuid;

class Ticket implements JsonSerializable
{
    private string $id;
    private int $amount;
    private float $calc_price;
    private ?int $dance_event_id = null;
    private ?int $history_tour_id = null;
    private ?int $reservation_id = null;
    private ?int $user_id = null;
    private ?int $order_id = null;

    public function __construct() {
        //$this->id = Uuid::uuid4()->toString();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getCalcPrice(): float
    {
        return $this->calc_price;
    }

    public function setCalcPrice(float $calc_price): void
    {
        $this->calc_price = $calc_price;
    }


    //Getter used to retrieve the ticket price for complex event tables
    //Used when one table is composed of more tables and they are not joined due to database design 
    public function getTicketPrice(): float
    {
        return fdiv($this->calc_price, $this->amount) * $this->amount;
    }


    public function getDanceEventId(): ?int
    {
        return $this->dance_event_id;
    }

    public function setDanceEventId(int $dance_event_id): void
    {
        $this->dance_event_id = $dance_event_id;
    }

    public function getHistoryTourId(): ?int
    {
        return $this->history_tour_id;
    }

    public function setHistoryTourId(int $history_tour_id): void
    {
        $this->history_tour_id = $history_tour_id;
    }

    public function getReservationId(): ?int
    {
        return $this->reservation_id;
    }

    public function setReservationId(int $reservation_id): void
    {
        $this->reservation_id = $reservation_id;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(?int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function getOrderId(): ?int
    {
        return $this->order_id;
    }

    public function setOrderId(?int $order_id): void
    {
        $this->order_id = $order_id;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'calc_price' => $this->calc_price,
            'dance_event_id' => $this->dance_event_id,
            'history_tour_id' => $this->history_tour_id,
            'reservation_id' => $this->reservation_id,
            'user_id' => $this->user_id,
            'order_id' => $this->order_id
        ];
    }

}