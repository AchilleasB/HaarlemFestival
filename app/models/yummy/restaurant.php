<?php

class Restaurant
{
    protected int $id;
    protected string $name;
    protected int $number_of_stars;
    protected string $banner;
    protected string $cuisines;

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

    public function getLocation(): string
    {
        return $this->location;
    }

    public function setLocation(string $location): void
    {
        $this->location = $location;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getNumberOfSeats(): int
    {
        return $this->number_of_seats;
    }

    public function setNumberOfSeats(string $number_of_seats): void
    {
        $this->number_of_seats = $number_of_seats;
    }

    public function getNumberOfStars(): int
    {
        return $this->number_of_stars;
    }

    public function setNumberOfStars(int $number_of_stars): void
    {
        $this->number_of_stars = $number_of_stars;
    }

    public function getBanner(): string
    {
        return $this->banner;
    }

    public function setBanner(string $banner): void
    {
        $this->banner = $banner;
    }

    public function getCuisines(): string
    {
        return $this->cuisines;
    }

    public function setCuisines(string $cuisines): void
    {
        $this->cuisines = $cuisines;
    }
} 