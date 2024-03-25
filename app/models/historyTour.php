<?php

class HistoryTour
{
    private int $id;
    private string $date;
    private string $time;
    private string $guide;
    private string $language; 

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getTime(): string
    {
        return $this->time;
    }

    public function setTime(string $time): void
    {
        $this->time = $time;
    }

    public function getGuide(): string
    {
        return $this->guide;
    }

    public function setGuide(string $guide): void
    {
        $this->guide = $guide;
    }
    public function getLanguage(): string 
    {
        return $this->language;
    }

    public function setLanguage(string $language): void 
    {
        $this->language = $language;
    }
}
