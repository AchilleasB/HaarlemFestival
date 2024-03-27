<?php

class EventOverview
{
    private int $id;
    private ?string $title;
    private ?string $subTitle;
    private ?string $description;
    private ?string $locations;
    private ?string $schedule;
    private ?string $image;

    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = $id;
    }
  
    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getSubTitle(): ?string
    {
        return $this->subTitle;
    }

    public function setSubTitle($subTitle): void
    {
        $this->subTitle = $subTitle;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getLocations(): ?string
    {
        return $this->locations;
    }

    
    public function setLocations(?string $locations): void
    {
        $this->locations = $locations;
    }
    public function getSchedule(): ?string
    {
        return $this->schedule;
    }

    
    public function setSchedule(?string $schedule): void
    {
        $this->schedule = $schedule;
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