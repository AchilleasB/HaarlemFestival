<?php

class MenuItem implements JsonSerializable
{
    private int $id;
    private string $name;
    private string $description;
    private ?string $price_per_portion;

    /**
     * MenuItem constructor.
     * @param string $name
     * @param string $description
     * @param string|null $price_per_portion
     */
    public function __construct(string $name, string $description, ?string $price_per_portion)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price_per_portion = $price_per_portion;
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPricePerPortion(): ?string
    {
        return $this->price_per_portion;
    }

    public function setPricePerPortion(?string $price_per_portion): void
    {
        $this->price_per_portion = $price_per_portion;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'pricePerPortion' => $this->getPricePerPortion()
        ];
    }
} 