<?php

class RestaurantBase implements JsonSerializable
{
    private int $id;
    private string $name;
    private int $number_of_stars;
    private string $banner;
    private array $cuisines;

    /**
     * RestaurantBase constructor.
     * @param string $name
     * @param int $number_of_stars
     * @param string $banner
     * @param array $cuisines
     */
    public function __construct(string $name, int $number_of_stars, string $banner, array $cuisines)
    {
        $this->name = $name;
        $this->number_of_stars = $number_of_stars;
        $this->banner = $banner;
        $this->cuisines = $cuisines;
    }

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
        foreach ($this->cuisines as $cuisine) {
            $cuisinesData[] = [
                'id' => $cuisine->getId(),
                'name' => $cuisine->getName()
            ];
        }
        return $cuisinesData;
    }

    public function setCuisines(array $cuisines): void
    {
        $this->cuisines = $cuisines;
    }

    public function jsonSerialize(): mixed {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'numberOfStars' => $this->getNumberOfStars(),
            'banner' => $this->getBanner(),
            'cuisines' => $this->getCuisines()
        ];
    }
}