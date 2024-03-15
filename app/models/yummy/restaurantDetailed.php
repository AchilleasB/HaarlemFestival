<?php

class RestaurantDetailed extends RestaurantRecommended
{
    private string $location;
    private int $number_of_seats;
    private array $menu;
    private array $images;
    private array $sessions;

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

    public function setNumberOfSeats(int $number_of_seats): void
    {
        $this->number_of_seats = $number_of_seats;
    }

    public function getMenu($key) {
        return $this->menu[$key] ?? null;
    }

    public function setMenu($key, $value) {
        $this->menu[$key] = $value;
    }

    public function getImages(): array {
        return $this->images;
    }

    public function setImages(array $images): void {
        foreach ($images as $image) {
            if (!is_string($image)) {
                throw new InvalidArgumentException('Each image must be a string');
            }
        }

        $this->images = $images;
    }

    public function getSessions(): array {
        $sessionDates = [];
        foreach ($this->sessions as $session) {
            $sessionDates[] = $session->__toString();
        }
        return $sessionDates;
    }
    
    public function setSessions(array $sessions): void {
        $this->sessions = $sessions;
    }

    public function addToStringArray(string $image): void {
        $this->images[] = $image;
    }
} 