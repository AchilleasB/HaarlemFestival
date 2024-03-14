<?php

class RestaurantBase
{
    protected int $id;
    protected string $name;
    protected int $number_of_stars;
    protected string $banner;
    protected array $cuisines;

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

    public function getCuisines(): array
    {
        return $this->cuisines;
    }

    public function setCuisines(array $cuisines): void
    {
        $this->cuisines = $cuisines;
    }
}
