<?php

class Session implements JsonSerializable
{
    private int $id;
    private DateTime $start_date;
    private DateTime $end_date;

     /**
     * Session constructor.
     * @param DateTime $start_date
     * @param DateTime $end_date
     */
    public function __construct(DateTime $start_date, DateTime $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getStartDate(): DateTime
    {
        return $this->start_date;
    }

    public function setStartDate(DateTime $start_date): void
    {
        $this->start_date = $start_date;
    }

    public function getEndDate(): DateTime
    {
        return $this->end_date;
    }

    public function setEndDate(DateTime $end_date): void
    {
        $this->end_date = $end_date;
    }

    public function __toString(): string
    {
        return sprintf(
            "%s, %s",
            $this->getStartDate()->format('d.m.Y - H:i'),
            $this->getEndDate()->format('H:i - d.m.Y')
        );
    }

    public function jsonSerialize(): mixed {
        return [
            'id' => $this->getId(),
            'startDate' => $this->getStartDate()->format('d.m.Y - H:i'),
            'endDate' => $this->getEndDate()->format('H:i - d.m.Y')
        ];
    }
    
}
