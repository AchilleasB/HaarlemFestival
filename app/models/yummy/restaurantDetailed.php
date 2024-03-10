<?php

class Restaurant extends RestaurantRecommended
{
    private string $location;
    private int $number_of_seats;

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function getNumberOfSeats(): int
    {
        return $this->number_of_seats;
    }

    public function setNumberOfSeats(string $number_of_seats): void
    {
        $this->number_of_seats = $number_of_seats;
    }
} 