<?php

class DrinkItem extends MenuItem
{
    private string $price_bottle;

    public function getPriceBottle(): string
    {
        return $this->price_bottle;
    }

    public function setPriceBottle(string $price_bottle): void
    {
        $this->price_bottle = $price_bottle;
    }
}