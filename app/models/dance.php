<?php

class Dance implements JsonSerializable
{
    private int $id;
    private int $venue_id;
    private string $venue_name;
    private string $date;
    private string $start_time;
    private string $end_time;
    private string $session;
    private int $tickets_available;
    private float $price;
    private string $type;
    private array $artists = [];

    const SINGLE_CONCERT = 'SINGLE-CONCERT';
    const ONE_DAY_PASS = '1-DAY-PASS';
    const THREE_DAY_PASS = '3-DAY-PASS';

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getVenueId(): int
    {
        return $this->venue_id;
    }
    public function setVenueId(int $venue_id): void
    {
        $this->venue_id = $venue_id;
    }
    public function getVenueName(): string
    {
        return $this->venue_name;
    }
    public function setVenueName(string $venue_name): void
    {
        $this->venue_name = $venue_name;
    }
    public function getDate(): string
    {
        return $this->date;
    }
    public function setDate(string $date): void
    {
        $this->date = $date;
    }
    public function getStartTime(): string
    {
        return $this->start_time;
    }
    public function setStartTime(string $start_time): void
    {
        $this->start_time = $start_time;
    }
    public function getEndTime(): string
    {
        return $this->end_time;
    }
    public function setEndTime(string $end_time): void
    {
        $this->end_time = $end_time;
    }
    public function getSession(): string
    {
        return $this->session;
    }
    public function setSession(string $session): void
    {
        $this->session = $session;
    }
    public function getTicketsAvailable(): int
    {
        return $this->tickets_available;
    }
    public function setTicketsAvailable(int $tickets_available): void
    {
        $this->tickets_available = $tickets_available;
    }
    public function getPrice(): float
    {
        return $this->price;
    }
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
    public function getType(){
        return $this->type;
    }
    public function setType($type){
        if ($type !== self::SINGLE_CONCERT && $type !== self::ONE_DAY_PASS && $type !== self::THREE_DAY_PASS){
            throw new Exception('Invalid type');
        }
        $this->type = $type;
    }
    public function getArtists(): array
    {
        return $this->artists;
    }
    public function setArtists(array $artists): void
    {
        $this->artists = $artists;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'venue_id' => $this->venue_id,
            'date' => $this->date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'session' => $this->session,
            'tickets_available' => $this->tickets_available,
            'price' => $this->price,
            'type' => $this->type,
            'artists' => $this->artists,
            'venue_name' => $this->venue_name
        ];
    }
}