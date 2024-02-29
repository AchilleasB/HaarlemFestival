<?php

class DanceTicket implements JsonSerializable
{
    private int $id;
    private int $amount;
    private int $event_id;
    private int $user_id;

    public function getId(): int
    {
        return $this->id;
    }
    public function setId($id): void
    {
        $this->id = $id;
    }
    public function getAmount(): int
    {
        return $this->amount;
    }
    public function setAmount($amount): void
    {
        $this->amount = $amount;
    }
    public function getEventId(): int
    {
        return $this->event_id;
    }
    public function setEventId($event_id): void
    {
        $this->event_id = $event_id;
    }
    public function getUserId(): int
    {
        return $this->user_id;
    }
    public function setUserId($user_id): void
    {
        $this->user_id = $user_id;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'amount' => $this->amount,
            'event_id' => $this->event_id,
            'user_id' => $this->user_id
        ];
    }
}