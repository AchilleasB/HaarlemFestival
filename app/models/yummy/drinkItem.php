<?php

class DrinkItem extends MenuItem
{
    private string $price_bottle;

    /**
     * DrinkItem constructor.
     * @param string $name
     * @param string $description
     * @param string|null $price_per_portion
     * @param string $price_bottle
     */
    public function __construct(string $name, string $description, ?string $price_per_portion, string $price_bottle)
    {
        parent::__construct($name, $description, $price_per_portion);
        $this->price_bottle = $price_bottle;
    }

    public function getPriceBottle(): string
    {
        return $this->price_bottle;
    }

    public function setPriceBottle(string $price_bottle): void
    {
        $this->price_bottle = $price_bottle;
    }

    public function jsonSerialize(): mixed
    {
        $data = parent::jsonSerialize();
        $data['priceBottle'] = $this->getPriceBottle();

        return $data;
    }
}