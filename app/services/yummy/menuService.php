<?php

require_once(__DIR__ . '/../../repositories/yummy/menuRepository.php');

class MenuService
{
    private $menuRepository;

    public function __construct()
    {
        $this->menuRepository = new MenuRepository();
    }

    public function getMenuForRestaurant($restaurantId)
    {
        return $this->menuRepository->getMenuForRestaurant($restaurantId);
    }

    public function addMenuItemToRestaurant($restaurantId, $itemType, $itemName, $itemDescription, $itemPricePerPortion, $itemPricePerBottle)
    {
        if ($itemType === 'food') {
            $menuItem = new MenuItem($itemName, $itemDescription, $itemPricePerPortion);
            return $this->menuRepository->addMenuItemToRestaurant($restaurantId, $menuItem);
        } else if ($itemType === 'drink') {
            $menuItem = new MenuItem($itemName, $itemDescription, $itemPricePerPortion);
            $menuItemId = $this->menuRepository->addMenuItemToRestaurant($restaurantId, $menuItem);
            $drinkItem = new DrinkItem($itemName, $itemDescription, $itemPricePerPortion, $itemPricePerBottle);
            $drinkItem->setId($menuItemId);
            return $this->menuRepository->addDrinkToRestaurant($drinkItem);
        } else {
            throw new Exception("Invalid item type");
        }
    }

    public function deleteMenuItem($menuItemId) {
        return $this->menuRepository->deleteMenuItem($menuItemId);
    }

    public function updateMenuItem($menuItemId, $itemName, $itemDescription, $itemPricePerPortion, $itemPricePerBottle, $itemType) {
        if ($itemType === 'food') {
            $menuItem = new MenuItem($itemName, $itemDescription, $itemPricePerPortion);
            $menuItem->setId($menuItemId);
            return $this->menuRepository->updateMenuItem($menuItem);
        } else if ($itemType === 'drink') {
            $menuItem = new MenuItem($itemName, $itemDescription, $itemPricePerPortion);
            $menuItem->setId($menuItemId);
            $this->menuRepository->updateMenuItem($menuItem);
            $drinkItem = new DrinkItem($itemName, $itemDescription, $itemPricePerPortion, $itemPricePerBottle);
            $drinkItem->setId($menuItemId);
            return $this->menuRepository->updateDrink($drinkItem);
        } else {
            throw new Exception("Invalid item type");
        }
    }
}

?>