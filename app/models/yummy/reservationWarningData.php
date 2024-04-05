<?php

class ReservationWarningData implements JsonSerializable
{
    private int $numberOfReservations;
    private int $numberOfPeople;
    private int $numberOfRestaurants;

    /**
     * Reservation constructor.
     * @param int|null $numberOfReservations
     * @param int|null $numberOfPeople
     * @param int|null $numberOfRestaurants
     */
    public function __construct(?int $numberOfReservations, ?int $numberOfPeople, ?int $numberOfRestaurants)
    {
        $this->numberOfReservations = $numberOfReservations ?? 0;
        $this->numberOfPeople = $numberOfPeople ?? 0;
        $this->numberOfRestaurants = $numberOfRestaurants ?? 0;
    }

    public function getNumberOfReservations(): int
    {
        return $this->numberOfReservations;
    }

    public function getNumberOfPeople(): int
    {
        return $this->numberOfPeople;
    }

    public function getNumberOfRestaurants(): int
    {
        return $this->numberOfRestaurants;
    }

    public function jsonSerialize():mixed
    {
        return [
            'numberOfReservations' => $this->getNumberOfReservations(),
            'numberOfPeople' => $this->getNumberOfPeople(),
            'numberOfRestaurants' => $this->getNumberOfRestaurants()
        ];
    }
}