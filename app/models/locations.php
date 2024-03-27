<?php

 class Location
{
    private int $id;
    private string $location_name;
    private string $address;
    private ?string $description;
    


    /**
     * @return int
     */
    public function getd(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->location_name;
    }

    /**
     * @param string $name
     */
    public function setName(string $location_name): void
    {
        $this->location_name = $location_name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @param string|null $address_1
     */
    public function setAddress(?string $address): void
    {
        $this->address= $address;
    }
}