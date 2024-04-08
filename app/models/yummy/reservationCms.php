<?php

class ReservationCms implements JsonSerializable
{
    private int $id;
    private ?string $restaurantName;
    private ?string $userLastname;
    private ?DateTime $sessionStartTime;
    private ?DateTime $sessionEndTime;
    private int $numberOfPeople;
    private string $mobileNumber;
    private ?string $remark;
    private bool $isActive;

    /**
     * Reservation constructor.
     * @param string|null $restaurantName
     * @param string|null $userLastname
     * @param ?DateTime $sessionStartTime
     * @param ?DateTime $sessionEndTime
     * @param int $numberOfPeople
     * @param string $mobileNumber
     * @param string|null $remark
     * @param bool $isActive
     */
    public function __construct(
        ?string $restaurantName, 
        ?DateTime $sessionStartTime, 
        ?DateTime $sessionEndTime, 
        ?string $userLastname, 
        int $numberOfPeople, 
        string $mobileNumber, 
        ?string $remark, 
        bool $isActive
    ) {
        $this->restaurantName = $restaurantName;
        $this->sessionStartTime = $sessionStartTime;
        $this->sessionEndTime = $sessionEndTime;
        $this->userLastname = $userLastname;
        $this->numberOfPeople = $numberOfPeople;
        $this->mobileNumber = $mobileNumber;
        $this->remark = $remark;
        $this->isActive = $isActive;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getRestaurantName(): string
    {
        return $this->restaurantName;
    }

    public function getUserLastname(): string
    {
        return $this->userLastname;
    }

    public function getSessionStartTime(): DateTime
    {
        return $this->sessionStartTime;
    }

    public function getSessionEndTime(): DateTime
    {
        return $this->sessionEndTime;
    }

    public function getNumberOfPeople(): int
    {
        return $this->numberOfPeople;
    }

    public function setNumberOfPeople(int $numberOfPeople): void
    {
        $this->numberOfPeople = $numberOfPeople;
    }

    public function getMobileNumber(): string
    {
        return $this->mobileNumber;
    }

    public function setMobileNumber(string $mobileNumber): void
    {
        $this->mobileNumber = $mobileNumber;
    }

    public function getRemark(): ?string
    {
        return $this->remark;
    }

    public function setRemark(?string $remark): void
    {
        $this->remark = $remark;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'restaurantName' => $this->restaurantName,
            'sessionStartTime' => $this->sessionStartTime ? $this->sessionStartTime->format('d.m.Y - H:i') : null,
            'sessionEndTime' => $this->sessionEndTime ? $this->sessionEndTime->format('H:i - d.m.Y') : null,
            'userLastname' => $this->userLastname,
            'numberOfPeople' => $this->numberOfPeople,
            'mobileNumber' => $this->mobileNumber,
            'remark' => $this->remark ?? '',
            'isActive' => $this->isActive
        ];
    }
}
