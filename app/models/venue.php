<?php

class Venue implements JsonSerializable
{
    private int $id;
    private string $name;
    private string $address;
    private string $venue_image;

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function getAddress(): string
    {
        return $this->address;
    }
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }
    public function getVenueImage(): string
    {
        return $this->venue_image;
    }
    public function setVenueImage(string $venue_image): void
    {
        $this->venue_image = $venue_image;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'venue_image' => $this->venue_image
        ];
    }
}