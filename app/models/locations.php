<?php

 class Location
{
    private int $id;
    private string $location_name;
    private string $address;
    private ?string $description;
    private ?string $link;
    private ?string $image;
    
    
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
  
    public function getLocationName(): string
    {
        return $this->location_name;
    }

    
    public function setLocationName(string $location_name): void
    {
        $this->location_name = $location_name;
    }

   
    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address= $address;
    }
    public function getLinks(): ?string
    {
        return $this->link;
    }

    public function setLinks(?string $link): void
    {
        $this->link= $link;
    }
    public function getImage(): ?string
    {
        return $this->image;
    }
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }
}

   

  
