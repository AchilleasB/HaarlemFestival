<?php

require_once __DIR__ . ' /../../models/yummy/menuItem.php';
require_once __DIR__ . ' /../../models/yummy/drinkItem.php';

class MenuRepository extends Repository
{
    public function getMenuForRestaurant($restaurantId) {
        $menuItems = [];
        $stmt = $this->connection->prepare("
            SELECT mi.*, d.price_bottle 
            FROM menu_items mi
            LEFT JOIN drinks d ON mi.id = d.id
            WHERE mi.restaurant_id = ?");
        $stmt->execute([$restaurantId]);
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (is_null($row['price_bottle'])) {
                // It's a regular menu item (food), not a drink
                $menuItem = new MenuItem();
                $menuItem->setId($row['id']);
                $menuItem->setName($row['name']);
                $menuItem->setDescription($row['description']);
                // Handle NULL value for price per portion
                $menuItem->setPricePerPortion($row['price_per_portion'] ?? null);
                $menuItems['food'][] = $menuItem;
            } else {
                // It's a drink
                $drinkItem = new DrinkItem();
                $drinkItem->setId($row['id']);
                $drinkItem->setName($row['name']);
                $drinkItem->setDescription($row['description']);
                // Handle NULL value for price per portion
                $drinkItem->setPricePerPortion($row['price_per_portion'] ?? null);
                $drinkItem->setPriceBottle($row['price_bottle']);
                $menuItems['drinks'][] = $drinkItem;
            }
        }
    
        return $menuItems;
    }
    
}