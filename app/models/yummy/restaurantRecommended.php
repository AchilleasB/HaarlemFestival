<?php

class RestaurantRecommended extends RestaurantBase
{
    private string $description;

    /**
     * RestaurantRecommended constructor.
     * @param string $name
     * @param int $number_of_stars
     * @param string $banner
     * @param array $cuisines
     * @param string $description
     */
    public function __construct(string $name, int $number_of_stars, string $banner, array $cuisines, string $description)
    {
        parent::__construct($name, $number_of_stars, $banner, $cuisines);
        $this->description = $description;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function jsonSerialize(): mixed
    {
        $data = parent::jsonSerialize();
        $data['description'] = $this->getDescription();

        return $data;
    }
} 