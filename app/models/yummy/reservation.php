<?php

class Reservation implements JsonSerializable
{
    private int $id;
    private int $restaurantId;
    private int $sessionId;
    private ?int $userId;
    private int $numberOfPeople;
    private string $mobileNumber;
    private ?string $remark;
    private bool $isActive;

    /**
     * Reservation constructor.
     * @param int $restaurantId
     * @param int $sessionId
     * @param int|null $userId
     * @param int $numberOfPeople
     * @param string $mobileNumber
     * @param string|null $remark
     * @param bool $isActive
     */
    public function __construct(
        int $restaurantId,
        int $sessionId,
        ?int $userId,
        int $numberOfPeople,
        string $mobileNumber,
        ?string $remark,
        bool $isActive
    ) {
        $this->restaurantId = $restaurantId;
        $this->sessionId = $sessionId;
        $this->userId = $userId;
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

    public function getRestaurantId(): int
    {
        return $this->restaurantId;
    }

    public function setRestaurantId(int $restaurantId): void
    {
        $this->restaurantId = $restaurantId;
    }

    public function getSessionId(): int
    {
        return $this->sessionId;
    }

    public function setSessionId(int $sessionId): void
    {
        $this->sessionId = $sessionId;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
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
            'id' => $this->getId(),
            'restaurantId' => $this->getRestaurantId(),
            'sessionId' => $this->getSessionId(),
            'userId' => $this->getUserId(),
            'numberOfPeople' => $this->getNumberOfPeople(),
            'mobileNumber' => $this->getMobileNumber(),
            'remark' => $this->getRemark(),
            'isActive' => $this->getIsActive()
        ];
    }
}
