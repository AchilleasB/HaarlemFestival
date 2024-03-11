<?php

class RestaurantImage
{
    private int $id;
    private string $uri;
    private int $restaurant_id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    public function getRestaurantId(): int
    {
        return $this->restaurant_id;
    }

    public function setRestaurantId(int $restaurant_id): void
    {
        $this->restaurant_id = $restaurant_id;
    }
}
